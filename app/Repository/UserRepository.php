<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User; 

use Exception;
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
            
            return parent::create($data); 

       }catch(Exception $e){ 
           throw new Exception($e->getMessage());
       }
        
    }

    
 
}