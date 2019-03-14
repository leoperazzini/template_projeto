<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Mail; 

use App\Repository\UserRepository;

use App\Models\User; 

use Exception; 
use DB; 
use Validator;

class UserRepository extends GenericRepository
{ 

    public function __construct()
    {
        $user = new User;
        $this->model = $user;
    }

    public function create($data)
    {      
        try{ 
            $data['password'] = Hash::make($data['password'], [
                'rounds' => 12
            ]); 
            $data['date_birth']  =  Carbon::createFromFormat('d/m/Y', $data['date_birth']);
             
            return parent::create($data); 

       }catch(Exception $e){ 
           throw new Exception($e->getMessage());
       }
        
    }

    public function update($id, $data)
    {      
        try{   
            $data['date_birth']  =  Carbon::createFromFormat('d/m/Y', $data['date_birth']);
             
            return parent::update($id,$data); 

       }catch(Exception $e){ 
           throw new Exception($e->getMessage());
       }
        
    }

    public function delete($id)
    {      
        try{ 
              
            return parent::delete($id); 

       }catch(Exception $e){ 
           throw new Exception($e->getMessage());
       }
        
    }

    public function sendemailnewpassword($email, $user_id){
        try{
        
          $data['public_link_code'] = bcrypt($email);
 
          $this->model
          ->findOrFail($user_id)
          ->update($data);
 
          Mail::send([], [], function ($message) use ($email , $data , $user_id){
   
            $link = url()->current();
            $exploded = explode ( '/', $link);
             
            $link = $exploded[0].'/'.$exploded[1].'/'.$exploded[2].'';
            $link = $link.'/users/resetpassword?public_link_code='.$data['public_link_code'].'&email='.$email;  
    
            $html = '
              <html>
                <body> 
                    <p>Olá!</p>
                    <p></p>
                    <p>Foi solicitado a definição de uma nova senha para o aplicativo Alerta de Risco para este e-mail.</p>
                    <p></p>
                    <p><b>Clique no link a seguir abaixo para ser redirecionado para a tela de definição de nova senha.</b></p>
                    <p><a href="'.$link.'"><b>'.$link.'</b></a></p>
                    <p>Caso você não tenha solicitado a alteração da senha, favor desconsiderar este e-mail</p>
                    <p>Att, <br>
                    Administração Grupo Unicad.</p>
                </body>
              </html>
            ';
    
            $message->to($email)
              ->from(env('MAIL_USERNAME' , "envio@grupounicad.com.br"))
              ->subject('Definir nova senha - Template Projeto')
              ->setBody($html ,'text/html'); 
    
          });
          
          return true;
    
        }catch(Exception $e) { 
          throw new Exception($e->getMessage());
        }
     
      }
    
      public function changePasswordUser($data){ 

        if(isset($data['public_link_code']) && isset($data['email'])){
          $users = $this->model->where('public_link_code', 'like', $data['public_link_code'])
          ->where('email', '=', $data['email'])
          ->get();
  
          $user = $users[0];
  
          $dataUpdate['password'] = bcrypt($data['password']);
  
          $this->model
          ->findOrFail($user->id)
          ->update($dataUpdate);
  
          return true;
        } 
  
       return false;
    }
 
}
