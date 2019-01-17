<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entrega;  
use App\BI\entregaBI; 
use Exception;


class EntregaController extends Controller
{
    public function listar(){
    	$entregaBI = new entregaBI;

    	// se recebeu alguma mensagem de sucesso ou erro de algum outro metodo através do redirect
    	$mensagem = session('mensagem'); 

    	// o metodo pode retornar tudo ou apenas um registro caso a busca seja com id  
    	$entregas = $entregaBI->consulta(); 
  
    	return view('/entrega/listar' , ['entregas' => $entregas , 'mensagem' => $mensagem ] );
    }

    public function deletar($id){

    	try{ 
	    	$entregaBI = new entregaBI;
  
	    	$retorno_delecao = null; 

	    	if(!empty($id)){
	    		// Se recebeu algum  id, envia o dado para o BI e ele irá ter a tarefa de deletar

	    		$retorno_delecao = $entregaBI->deletar($id);
  
	    	}
  
	    }catch(Exception $e){
	    	// em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
	    	$retorno_delecao['msg_erro'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();

	    }

		return redirect('/entrega/listar/')->with(['mensagem' => $retorno_delecao]); 
    }

    public function cadastrar(){

    	try{ 
	    	$entregaBI = new entregaBI;

	    	$retorno_cadastro = null;
	    	$dados = null;

	    	if(!empty(request()->all())){
	    		// Se recebeu algum dado de cadastro, envia o dado para o BI e ele irá cadastrar.
	    		$dados = request()->all();
	    		$retorno_cadastro = $entregaBI->cadastrar($dados);


	    		// se teve erro, os dados continuam o mesmo do cadastro e envia uma mensagem de erro para a view, caso tenha sido um sucesso o cadastro, envia a mensagem a reseta o formulario
	    		if(empty($retorno_cadastro['msg_erro'])){
	    			$dados = null;
	    		}
	 			
	    	} 

	    }catch(Exception $e){
	    	// em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
	    	$retorno_cadastro['msg_erro'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();

	    }

	    if(!empty($retorno_cadastro['msg_erro']) || empty($retorno_cadastro)){
	    	return view('/entrega/cadastrar' , ['mensagem' => $retorno_cadastro , 'dados' => $dados] );
	    }else{
	    	return redirect('/entrega/listar/')->with(['mensagem' => $retorno_cadastro]); 
	    }

    	
    }

    public function editar($id){

    	if(empty(request()->all())){
    		 
    		try{ 

    			$entregaBI = new entregaBI;
    			$mensagem = null;
    			$entrega = $entregaBI->consulta($id);
	     	

		    }catch(Exception $e){
		    	// em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
		    	$mensagem['msg_erro'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();

		    } 

		    return view('/entrega/editar' , ['mensagem' => $mensagem ,  'dados' => $entrega] ); 
     
    	}else{

    	    try{ 

    			$entregaBI = new entregaBI;
    			$mensagem = null;
    			$dados = request()->all(); 

    			$retorno_editar = $entregaBI->editar($dados['id'] , $dados);
	     	

		    }catch(Exception $e){
		    	// em caso de exception, avisa para o usuário de um modo diferente. Por ser um erro não esperado e de programação
		    	$retorno_editar['msg_erro'] = 'Erro na operação! Por favor contactar o suporte técnico'.$e->getMessage();

		    } 

		    if(!empty($retorno_editar['msg_erro'])){
		    	return view('/entrega/editar' , ['mensagem' => $retorno_editar ,  'dados' => $dados] ); 
		    }else{
		    	return redirect('/entrega/listar/')->with(['mensagem' => $retorno_editar]);
		    }
 
    	
    	}

    
	}
}