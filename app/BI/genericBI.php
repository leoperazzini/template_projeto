<?php

namespace App\BI;

use DateTime;
use Exception;
    
class genericBI
{

     public function validaData($data_validar){ 
     	// valida se a data está no padrao brasileiro ou não
     	try{

	 		$data = DateTime::createFromFormat('d/m/Y', $data_validar);
			if($data && $data->format('d/m/Y') ===  $data_validar){
			   return true;
			}else{
				return false;
			}

		}catch(Exception $e){

	    	throw new Exception($e->getMessage(), 1); 
	    }
    }  

    public function timeStampToDataBrasil($data_validar){ 
    	// passa a data de padrao br para timestamp do banco
    	try{

    		$data = DateTime::createFromFormat('d/m/Y', $data_validar);
			return date_format($data, 'Y-m-d H:i:s');

    	}catch(Exception $e){

	    	throw new Exception($e->getMessage(), 1); 
	    }
 		
    }

}
