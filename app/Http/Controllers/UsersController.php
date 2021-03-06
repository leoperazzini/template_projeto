<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Repository\UserRepository;

use Exception;
use Validator;



class UsersController extends Controller
{
    private $UserRepository;

    public function __construct()
    {
        $UserRepository = new UserRepository;
        $this->UserRepository = $UserRepository;
    }

    //  
    public function store(Request $request)
    {     
        try{ 
            if($request->isMethod('get')){
                return view('/users/store' , ['data'=> null, 'errors' => null , 'message' =>null]);
            }

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',  
                'password' => 'required', 
                'date_birth' => 'required|date_format:"d/m/Y"',
            ],
            [   
                'first_name.required' => 'Nome precisa ser preenchido', 
                'last_name.required' => 'Sobrenome precisa ser preenchido', 
                'email.required' => 'E-mail precisa ser preenchido', 
                'email.email' => 'E-mail não está no formato padrão de e-mails', 
                'password.required' => 'Senha precisa ser preenchido', 
                'date_birth.required' => 'Data de nascimento precisa ser preenchido', 
                'date_birth.date_format' => 'Data de nascimento deve estar no formato "dd/mm/yyyy"', 
            ]);

            $data_view = $request->all();

            $user_table = new User;

            $validator->after(function($validator) use ($user_table , $request) {                
                if(isset($request['email'][0])) { 

                    $user = $user_table->where('email', 'like', $request['email'])->get(); 
                    if(isset($user[0])) {
                        $validator->errors()->add('email', 'Já existe este e-mail cadastrado por outro usuário');
                    } 
                }
            });
           
            if ($validator->fails()) {
                //
                $errors = $validator->errors()->toArray();  

                return view('/users/store',  ['data'=>$data_view , 'errors' => $errors ] );
            } 

            $new_user = $this->UserRepository->create($data_view);
            
            if(!empty($new_user)){
                $data_view = null;
                $message_view['message_success'] = "Usuário cadastrado com sucesso!";
            }else{
                $message_view['message_error'] = "Não foi possível cadastrar um novo usuário";
            } 

            return view('/users/store',  ['data'=>$data_view , 'errors' => null , 'message' =>$message_view] );

        }catch(Exception $e){
            // em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
            $message_view['message_error'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return view('/users/store',  ['data'=>$data_view , 'errors' => null , 'message' =>$message_view ] );
        }
    }

    public function update($id , Request $request)
    {     
        try{ 
            $user = $this->UserRepository->find($id); 
            $user['date_birth'] = \Carbon\Carbon::parse($user['date_birth'])->format('d/m/Y') ; 

            if($request->isMethod('get')){ 
                
                return view('/users/update' , ['data'=> $user, 'errors' => null , 'message' =>null]);
            }

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',   
                'date_birth' => 'required|date_format:"d/m/Y"',
            ],
            [   
                'first_name.required' => 'Nome precisa ser preenchido', 
                'last_name.required' => 'Sobrenome precisa ser preenchido', 
                'email.required' => 'E-mail precisa ser preenchido', 
                'email.email' => 'E-mail não está no formato padrão de e-mails',  
                'date_birth.required' => 'Data de nascimento precisa ser preenchido', 
                'date_birth.date_format' => 'Data de nascimento deve estar no formato "dd/mm/yyyy"', 
            ]);

            $data_view = $request->all();
 
            $user_table = new User;

            $validator->after(function($validator) use ($user_table , $request) {                
                if(isset($request['email'][0])) { 

                    $user = $user_table->where('email', 'like', $request['email'])->where('id', '<>' , $request['id'])->get(); 
                    if(isset($user[0])) {
                        $validator->errors()->add('email', 'Já existe este e-mail cadastrado por outro usuário');
                    } 
                }
            }); 
            if ($validator->fails()) {
                //
                $errors = $validator->errors()->toArray();  

                return view('/users/update',  ['data'=>$data_view , 'errors' => $errors ] );
            } 
             
            $user = $this->UserRepository->update($id, $data_view);
 
            if($user == true){
                $user = $this->UserRepository->find($id);
                $message_view['message_success'] = "Usuário editado com sucesso!";
            }else{
                $message_view['message_error'] = "Não foi possível editado o usuário";
            } 

            return view('/users/update',  ['data'=>$data_view , 'errors' => null , 'message' =>$message_view] );

        }catch(Exception $e){
            // em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
            $message_view['message_error'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return view('/users/update',  ['data'=>$data_view , 'errors' => null , 'message' =>$message_view ] );
        }
    }

    public function delete($id)
    {     
        try{ 
 
            $user_deleted = $this->UserRepository->delete($id);
 
            if($user_deleted == true){ 
                $message_view['message_success'] = "Usuário excluído com sucesso!";

                if(Auth::user()->id == $id){
                    Auth::logout();
             
                    return redirect('/login')->with(['message'=>$message_view]);
                }
    
            }else{
                $message_view['message_error'] = "Não foi possível excluir o usuário";
            }  
 
            return redirect('users/getall')->with(['message'=>$message_view]);

        }catch(Exception $e){
            // em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
            $message_view['message_error'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return redirect('users/getall');
        }
    }
    
    public function getall(){
        
        try{ 

            $message_view = session('message');
            $data_view = null;
             

            $users = $this->UserRepository->getall();
             
            return view('/users/list',  ['users'=>$users , 'message' =>$message_view ] );

        }catch(Exception $e){
           
            $message_view['message_error'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return view('/users/list',  ['message' =>$message_view ] );
        }

    }
  
}
