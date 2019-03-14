<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repository\UserRepository;

use App\Models\User;

use Exception;
use Validator;

class AuthController extends Controller
{
    //  
    public function login(Request $request)
    {     
        try{
            $message_view = session('message');
             
            if($request->isMethod('get')){ 
                //dd($message_view );
                return view('/auth/login', ['errors' => null, 'message' => $message_view]);
            }

            $data_view['emaillogin'] =  $request[ 'emaillogin'];
            $data_view['passwordlogin'] = $request[ 'passwordlogin'];

            $validator = Validator::make($request->all(), [
                'emaillogin' => 'required',
                'passwordlogin' => 'required', 
            ],
            [
                'emaillogin.required' => 'E-mail precisa ser preenchido', 
                'passwordlogin.required' => 'Senha precisa ser preenchido', 
            ]);

            $user_table = new User;

            $validator->after(function($validator) use ($user_table , $request) {                
                if(isset($request['emaillogin'][0])) {  
                    $user = $user_table->where('email', 'like', $request['emaillogin'])->get(); 
                     
                    if(!isset($user[0])) { 
                        $validator->errors()->add('emaillogin', 'E-mail não cadastrado');
                    } 
                }
            });

            if ($validator->fails()) {
                //
                $errors = $validator->errors()->toArray();  
                return view('/auth/login',  ['data'=>$data_view , 'errors' => $errors] );
            }
      
            $credentials = $request->only('emaillogin', 'passwordlogin');
            // dd($credentials);
            $credentials['email'] = $credentials['emaillogin'] ; 
            unset($credentials['emaillogin']);
            $credentials['password'] = $credentials['passwordlogin'] ;
            unset($credentials['passwordlogin']);

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('/home');
            }

            $errors['login_failed'] = 'E-mail ou senha inválido!'; 
   
            return view('/auth/login',  ['data'=>$data_view ,  'errors' => $errors ] );

        }catch(Exception $e){
            // em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
            $errors['server_failed']  = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return view('/auth/login',  ['data'=>$data_view , 'errors' => $errors ] );
        }
    }

    public function logout(){ 
        Auth::logout();
        
        return redirect('/login'); 
    
    } 

    public function forgotmypassword(Request $request){ 
        
        $message_view = session('message');
             
        if($request->isMethod('get')){ 
            //dd($message_view );
            return view('/auth/forgotmypassword', ['errors' => null, 'message' => $message_view]);
        }

        try{
            $validator = Validator::make($request->all() , [
            'email' => 'required|email', 
                ],[
                    'email.required' => 'E-mail precisa ser preenchido',
                    'email.email' => 'E-mail com formato inválido', 
                ]
            ); 
 
            $validator->after(function($validator) use ($request) { 
                
                if(isset($request['email']) && ($request['email'] != null)){
                    $user_table = new User;
                    $user = $user_table->where('email', 'like', $request['email'])->get();
                    
                    if(!isset($user[0])){
                        $validator->errors()->add('email', 'Não existe este e-mail cadastrado para redefinir a senha');
                    }else{
                        $request['user_id'] = $user[0]->id;
                    }

                    if($request['email'] == ""){
                        $validator->errors()->add('email', 'E-mail precisa ser preenchido');
                    }

                }
            });
            
            if($validator->fails()){
                $errors = $validator->errors()->toArray();  
                return view('/auth/forgotmypassword',  ['data'=>$request , 'errors' => $errors] );
            }

            $UserRepository = new UserRepository;
            
            $sended = $UserRepository->sendemailnewpassword($request['email'], $request['user_id']);
             
            if($sended == true){ 
                $message_view['message_success'] = 'E-mail enviado com sucesso!';
                unset($request['email']);
            }else{
                $message_view['message_error'] = 'Não foi possível enviar o e-mail!';
            }  
                 
            return view('/auth/forgotmypassword',  ['message' => $message_view , 'errors' => null , 'data'=>$request] );

        }catch(Exception $e) {  
            $message_view['message_error']  = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            return view('/auth/forgotmypassword',  ['message' => $message_view , 'errors' => null , 'data'=>$request] );
        }
    
    } 
  
}
