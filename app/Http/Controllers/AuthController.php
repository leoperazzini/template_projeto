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
  
}
