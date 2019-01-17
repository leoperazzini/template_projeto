<?php

namespace Tests\Unit;

use App\Entrega; 
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntregaTest extends TestCase
{ 
	// PODE USAR O COMANDO O REFRESH, POIS EM PHPUNIT.XML , ESTÁ SENDO USADO A BASE UNICADTDD PARA TESTES UNITARIOS
	use RefreshDatabase;

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testCadastroSucesso()
    {
        $this->assertTrue(true);

        $this->post('/entrega/cadastrar', 
        	[
        		'nome_cliente'=>'Cliente 1',
        		'data_entrega'=>'01/01/2019',
        		'endereco_partida' => 'Rio de janeiro, Rj , avenida jaime poggi, 99',
        		'endereco_destino' => 'Rio de janeiro, Rj'
        	]
    	)->assertStatus(200)->assertSee('Entrega cadastrada com sucesso!');
    }

    public function testCadastroErroDataEntrega()
    {
        $this->assertTrue(true);

        $this->post('/entrega/cadastrar', 
        	[
        		'nome_cliente'=>'Cliente 1',
        		'data_entrega'=>'01-01-2019',
        		'endereco_partida' => 'Rio de janeiro, Rj , avenida jaime poggi, 99',
        		'endereco_destino' => 'Rio de janeiro, Rj , avenida jaime poggi, 99'
        	]
    	)->assertStatus(200)->assertSee('Data inválida!');

    	$this->post('/entrega/cadastrar', 
        	[
        		'nome_cliente'=>'Cliente 1',
        		'data_entrega'=>'',
        		'endereco_partida' => 'Rio de janeiro, Rj , avenida jaime poggi, 99',
        		'endereco_destino' => 'Rio de janeiro, Rj , avenida jaime poggi, 99'
        	]
    	)->assertStatus(200)->assertSee('Data inválida!');
    }

    public function testCadastroErroNomeClienteVazio()
    {
        $this->assertTrue(true);

        $this->post('/entrega/cadastrar', 
        	[
        		'nome_cliente'=>'',
        		'data_entrega'=>'01/01/2019',
        		'endereco_partida' => 'Rio de janeiro, Rj , avenida jaime poggi, 99',
        		'endereco_destino' => 'Rio de janeiro, Rj , avenida jaime poggi, 99'
        	]
    	)->assertStatus(200)->assertSee('Nome do cliente não pode ser vazio!');
    }

    public function testCadastroErroEnderecoEntrega()
    {
        $this->assertTrue(true);

        $this->post('/entrega/cadastrar', 
        	[
        		'nome_cliente'=>'Cliente 1',
        		'data_entrega'=>'01/01/2019',
        		'endereco_partida' => '',
        		'endereco_destino' => 'Rio de janeiro, Rj , avenida jaime poggi, 99'
        	]
    	)->assertStatus(200)->assertSee('Endereço de partida não pode ser vazio!');
    }

    public function testCadastroErroEnderecoDestino()
    {
        $this->assertTrue(true);

        $this->post('/entrega/cadastrar', 
        	[
        		'nome_cliente'=>'Cliente 1',
        		'data_entrega'=>'01/01/2019',
        		'endereco_partida' => 'Rio de janeiro, Rj , avenida jaime poggi, 99',
        		'endereco_destino' => ''
        	]
    	)->assertStatus(200)->assertSee('Endereço de destino não pode ser vazio!');
    }


    public function testCadastroErroEnderecoDestinoIgualDePartida()
    {
        $this->assertTrue(true);

        $this->post('/entrega/cadastrar', 
        	[
        		'nome_cliente'=>'Cliente 1',
        		'data_entrega'=>'01/01/2019',
        		'endereco_partida' => 'Rio de janeiro, Rj , avenida jaime poggi, 99',
        		'endereco_destino' => 'Rio de janeiro, Rj , avenida jaime poggi, 99'
        	]
    	)->assertStatus(200)->assertSee('Endereço de partida não pode ser igual a endereço de destino!');
    }

    public function testDelecao()
    {
        $this->assertTrue(true);

        $this->post('/entrega/cadastrar', 
        	[
        		'nome_cliente'=>'Cliente 1',
        		'data_entrega'=>'01/01/2019',
        		'endereco_partida' => 'Rio de janeiro, Rj , avenida jaime poggi, 99',
        		'endereco_destino' => 'Rio de janeiro, Rj'
        	]
    	)->assertStatus(200)->assertSee('Entrega cadastrada com sucesso!');

    	$entrega = Entrega::first();

    	$this->get('/entrega/deletar/id/'.$entrega['id']);

    }
 

}
