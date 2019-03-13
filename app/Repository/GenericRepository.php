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

    public function delete($id)
    {
        try{ 
            return $this->model->destroy($id);

       }catch(Exception $e){ 
           throw new Exception($e->getMessage());
       }
    }

    public function update($id, $data)
    {      
        
        try{ 
             unset($data['id']);
             unset($data['_token']);
             return $this->model->where('id', $id)->update($data);

        }catch(Exception $e){ 
            throw new Exception($e->getMessage());
        }
    }

    

    public function find($id)
    {
        try{ 
            return $this->model->find($id);

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
