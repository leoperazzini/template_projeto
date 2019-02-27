<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
                'email' => Rule::unique('users'),
                'password' => 'required', 
                'date_birth' => 'required|date_format:"d/m/Y"',
            ],
            [   
                'first_name.required' => 'Nome precisa ser preenchido', 
                'last_name.required' => 'Sobrenome precisa ser preenchido', 
                'email.required' => 'E-mail precisa ser preenchido', 
                'email.email' => 'E-mail não está no formato padrão de e-mails',
                'email.unique' => 'Já existe este e-mail cadastrado por outro usuário', 
                'password.required' => 'Senha precisa ser preenchido', 
                'date_birth.required' => 'Data de nascimento precisa ser preenchido', 
                'date_birth.date_format' => 'Data de nascimento deve estar no formato "dd/mm/yyyy"', 
            ]);

            $data_view = $request->all();

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
    
    public function getall(){
        
        try{ 

            $message_view = null;
            $data_view = null;

            $users = $this->UserRepository->getall();
             
            return view('/users/list',  ['users'=>$users , 'message' =>$message_view ] );

        }catch(Exception $e){
           
            $message_view['message_error'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();
            
            return view('/users/list',  ['message' =>$message_view ] );
        }

    }
  
}
