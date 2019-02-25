<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Exception;
use Validator;

class GenericRepository
{
    protected $model;  

    public function create($data)
    {      
        
        try{ 
             return $this->model->create($data);

        }catch(Exception $e){ 
            throw new Exception($e->getMessage());
        }
    }
    
    public function getall()
    {      
        
        try{ 
             return $this->model->get();

        }catch(Exception $e){ 
            throw new Exception($e->getMessage());
        }
    }
}
