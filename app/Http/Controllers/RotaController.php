<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BI\entregaBI; 

class RotaController extends Controller
{
    public function roterizacao($id){
 		
 		$entregaBI = new entregaBI;

    	// o metodo pode retornar tudo ou apenas um registro caso a busca seja com id  
    	$entrega = $entregaBI->consulta($id); 
 
    	return view('/rota/roterizacao' , ['entrega' => $entrega] );
    }
}
