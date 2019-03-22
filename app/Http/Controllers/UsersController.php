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

            $return = $this->UserRepository->create($data_view);
            
            if(empty($return['error'])){
                $data_view = null;
                $message_view['message_success'] = "Usuário cadastrado com sucesso!";
            }else{
                $message_view['message_error'][] = "Não foi possível cadastrar um novo usuário";
                $message_view['message_error'][] = $return['error'];
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
// dd(session()->get('error'));
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
             
            $return = $this->UserRepository->update($id, $data_view);
  
            if(empty($return['error'])){
                $data_view = $return['user']; 
                $message_view['message_success'] = "Usuário editado com sucesso!";
            }else{
                $message_view['message_error'][] = "Não foi possível editado o usuário";
                $message_view['message_error'][] = $return['error'];
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

    public function sendresetpassword($id){
        try{ 
 
            $user = $this->UserRepository->find($id);

            $sended = $this->UserRepository->sendemailnewpassword($user['email'], $user['id']);
 
            if($sended == true){ 
                $message_view['message_success'] = 'E-mail enviado para "'.$user['email'].'" com sucesso!';
 
            }else{
                $message_view['message_error'] = 'Não foi possível enviar o e-mail para "'.$user['email'].'"!';
            }  
 
            return redirect('users/getall')->with(['message'=>$message_view]);

        }catch(Exception $e){
            // em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
            $message_view['message_error'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return redirect('users/getall');
        }
    }

    public function resetpassword(Request $request){ 
        try{ 
            $password_changed = false;
            $data = $request->all();
            $method = $request->method();

            $queryString = [
                'public_link_code' => !isset($data['public_link_code']) ?: $data['public_link_code'],
                'email' => !isset($data['email']) ?: $data['email']
            ];
           
            if ($method == 'POST')
            {  
                $data = $request->all();
                $validator = Validator::make($request->all() , [
                    'password' => 'required|min:6', 
                    'confirmpassword' => 'required', 
                        ],[
                            'password.required' => 'Necessário preencher o campo!',
                            'confirmpassword.required' => 'Necessário preencher o campo!',
                            'password.min' => 'Senha precisa ter no mínimo 6 digitos',
                        ]
                    ); 
    
                 $validator->after(function($validator) use ($data) {                
                        if( isset($data['password']) && isset($data['confirmpassword'])) {
                            if($data['password'] != $data['confirmpassword']) {
                                $validator->errors()->add('confirmpassword', 'Senhas não conferem!');
                            } 
                        }
                    });

                    $user_table = new User;

                $validator->after(function($validator) use ($user_table , $data) {     
                             
                        if(isset($data['email'])) {
                            $user = $user_table->where('email', 'like', $data['email'])->get(); 
 
                            if(!isset($user[0])) {
                                $validator->errors()->add('email', 'E-mail não encontrado');
                            } 
                        }
                });
                
                if($validator->fails()){ 
                    
                    return view('users/resetpassword'  
                    ,['errors' => $validator->errors()->toArray() , 'data'=>$request->all() , 'queryString' => $queryString]);
                }
 
                $password_changed = $this->UserRepository->changePasswordUser($request->all());
            }

            if($password_changed == true){
                unset($data['password']);
                unset($data['confirmpassword']);
            }
 
            return view('users/resetpassword' , ['data'=> $data, 'errors' => null , 'success'=>$password_changed,
                'queryString' => $queryString]);
 
        }catch(Exception $e) {   
            return view('users/resetpassword' ,  ['errors' => $e->getMessage()]);
        }
        
        return view('users/resetpassword' , ['data'=>$request->all() , 'errors' => null , 'queryString' => $queryString]);
      } 
  
}
