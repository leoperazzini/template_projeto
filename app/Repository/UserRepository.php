<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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

    
 
}
