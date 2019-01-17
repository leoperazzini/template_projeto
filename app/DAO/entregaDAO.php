<?php

namespace App\DAO;
   
use App\Entrega;  
use DB;
use Exception;

class entregaDAO
{	

	public function consulta($id=null){
		// EM CASO DE UMA CONSULTA MAIS COMPLEXA, BASTA APENAS CHAMAR O DAO E MODIFICAR APENAS ELE 
		try{ 
			$retorno = null;

			if(empty($id)){
				return $retorno = Entrega::all();
			}else{
				// caso ele esteja buscando apenas um item, para ficar no padrão de busca, ele será colocado na primeira posição do array para ficar igual ao retorno do metodo em caso de busca para todos
				return $retorno = Entrega::findOrFail($id);
			}

			 
		}catch(Exception $e){
	    	
	    	throw new Exception($e->getMessage(), 1); 
	    }
	}

}