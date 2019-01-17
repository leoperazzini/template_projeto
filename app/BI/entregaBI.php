<?php

namespace App\BI;
  
use App\BI\genericBI;
use App\DAO\entregaDAO;
use App\Entrega;  
use DB;
use Exception;

class entregaBI extends genericBI
{	

	public function consulta($id=null){
		try{
			$dao = new entregaDAO;

			return $dao->consulta($id);

		}catch(Exception $e){
	    	
	    	throw new Exception($e->getMessage(), 1); 
	    }
	}

    public function cadastrar($dados_cadastro){ 

    	try{
    		// inicio do controle de transação
    		DB::beginTransaction();

	    	$erro = $this->validaDados($dados_cadastro);

	    	// se tiver erro não inseri, caso contrário inseri diretamente no banco
	    	if(!empty($erro)){
	    		return array('msg_erro'=>$erro);
	    	}else{

	    		$entrega = new Entrega();

	    		$entrega->nome_cliente = trim($dados_cadastro['nome_cliente']);
	    		$entrega->data_entrega = $this->timeStampToDataBrasil($dados_cadastro['data_entrega']);
	    		$entrega->endereco_partida = trim($dados_cadastro['endereco_partida']);
	    		$entrega->endereco_destino = trim($dados_cadastro['endereco_destino']);

	    		$entrega->save();
  
	 			// Commitando os dados para banco caso nao tenha erro
	    		DB::commit();

	    		return array('msg_sucesso'=>'Entrega cadastrada com sucesso!');
	    	}
	    }catch(Exception $e){
	    	// controle de transação caso a operação falhe
	    	 DB::rollback();

	    	throw new Exception($e->getMessage(), 1); 
	    }
 
    }

    public function editar($id, $dados_edicao){ 

    	try{
    		// inicio do controle de transação
    		DB::beginTransaction();

	    	$erro = $this->validaDados($dados_edicao);

	    	// se tiver erro não edita, caso contrário edita diretamente no banco
	    	if(!empty($erro)){
	    		return array('msg_erro'=>$erro);
	    	}else{

	    		$dao = new entregaDAO;

				$entrega = $dao->consulta($id);

	    		$entrega->nome_cliente = trim($dados_edicao['nome_cliente']);
	    		$entrega->data_entrega = $this->timeStampToDataBrasil($dados_edicao['data_entrega']);
	    		$entrega->endereco_partida = trim($dados_edicao['endereco_partida']);
	    		$entrega->endereco_destino = trim($dados_edicao['endereco_destino']);

	    		$entrega->save();
  
	 			// Commitando os dados para banco caso nao tenha erro
	    		DB::commit();

	    		return array('msg_sucesso'=>'Entrega editada com sucesso!');
	    	}
	    }catch(Exception $e){
	    	// controle de transação caso a operação falhe
	    	 DB::rollback();

	    	throw new Exception($e->getMessage(), 1); 
	    }
 
    }

    

    public function deletar($id){ 

    	try{
    			// inicio do controle de transação
    			DB::beginTransaction();

    			$dao = new entregaDAO;

			    $entrega = $dao->consulta($id);

			    // só delete se o item existir, senão avisa que o item não existe	
			    if(!empty($entrega)){
			    	$entrega->delete($id);
			    }else{
			    	return array('msg_erro'=>'A entrega não existe em nosso banco de dados.');
			    }			
 
	 			// Commitando os dados para banco caso nao tenha erro
	    		DB::commit();

	    		return array('msg_sucesso'=>'Entrega excluída com sucesso!');
	    	
	    }catch(Exception $e){
	    	// controle de transação caso a operação falhe
	    	 DB::rollback();

	    	throw new Exception($e->getMessage(), 1); 
	    }
 
    }

    
    
    private function validaDados($dados){

    	$nome_cliente = $dados['nome_cliente'];
    	$data_entrega = $dados['data_entrega'];
		$endereco_partida = $dados['endereco_partida'];
		$endereco_destino = $dados['endereco_destino'];

		if(empty($nome_cliente)){
			return 'Nome do cliente não pode ser vazio!';
		}

		if(!$this->validaData($data_entrega)){
			return 'Data inválida!';
		}

		if(empty($endereco_partida)){
			return 'Endereço de partida não pode ser vazio!';
		}

		if(empty($endereco_destino)){
			return 'Endereço de destino não pode ser vazio!';
		}

		// o google maps quebra quando os endereços são iguais, então não permitir endereços iguais. No mundo real também não faz sentido
		if(trim($endereco_partida) == trim($endereco_destino)){
			return 'Endereço de partida não pode ser igual a endereço de destino!';
		}
 
    }
    
} 
 
 