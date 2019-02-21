<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return view('/users/store');
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

            if ($validator->fails()) {
                //
                $errors = $validator->errors();
                $message_view['message_error'] =$errors->all(); 

                return view('/users/store',  ['data'=>$data_view , 'message' =>$message_view ] );
            } 

            $new_user = $this->UserRepository->create($data_view);
            
            if(!empty($new_user)){
                $data_view = null;
                $message_view['message_success'] = "Usuário cadastrado com sucesso!";
            }else{
                $message_view['message_error'] = "Não foi possível cadastrar o novo usuário";
            } 

            return view('/users/store',  ['data'=>$data_view , 'message' =>$message_view ] );

        }catch(Exception $e){
            // em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
            $message_view['message_error'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return view('/users/store',  ['data'=>$data_view , 'message' =>$message_view ] );
        }
    }
  
}
