<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Validator;

class AuthController extends Controller
{
    //  
    public function login(Request $request)
    {     
        try{
            if($request->isMethod('get')){
                return view('/auth/login');
            }

            $data_view['email'] =  $request[ 'email'];
            $data_view['password'] = $request[ 'password'];

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required', 
            ],
            [
                'email.required' => 'E-mail precisa ser preenchido', 
                'password.required' => 'Senha precisa ser preenchido', 
            ]);

            if ($validator->fails()) {
                //
                $errors = $validator->errors();
                $message_view['message_error'] =$errors->all();
                return view('/auth/login',  ['data'=>$data_view , 'message' =>$message_view ] );
            }
      
            $credentials = $request->only('email', 'password');
            // dd($credentials);
            
            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('/home');
            }

            $message_view['message_error'] = 'E-mail ou senha inválido!'; 
   
            return view('/auth/login',  ['data'=>$data_view , 'message' =>$message_view ] );

        }catch(Exception $e){
            // em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
            $message_view['message_error'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return view('/auth/login',  ['data'=>$data_view , 'message' =>$message_view ] );
        }
    }

    public function logout(){ 
        Auth::logout();
        
        return redirect('/login'); 
    
    } 
  
}
