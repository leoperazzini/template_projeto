<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

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

    public function storeGenericFile($uploadedFile = null, $generic_id, $generic_path, $filename = 'generic_file' ,$extensions_allowed = ['jpg', 'jpeg' , 'JPG' , 'JPEG' , 'PNG' ,'png'] ){
        $return = null;
        if(isset($uploadedFile)){ 
            $extension = $uploadedFile->getClientOriginalExtension(); 
  
            if(in_array($extension , $extensions_allowed)){
                $storagePath = Storage::disk('public')->putFileAs(
                    $generic_path.$generic_id.'',
                    $uploadedFile,
                    $filename.'.'.$extension
                  );   

                  $return['success'] = $storagePath;
            }else{
                $return['error'] = 'A extensão '.$extension.' não é permitida. Apenas as extensões ( '.implode(' , ' , $extensions_allowed).') são permitidas';
            }
 
            
        } 
        return $return;
    }
}
