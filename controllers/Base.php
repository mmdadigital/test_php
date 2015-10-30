<?php
namespace Controllers;
/**
 * 28/10/2015 19h
 * Classe desenvolvida apenas para o teste da MMDA
 * Cada método de um controller concreto deve retornar uma string
 * Diferente de outros frameworks, aqui voce não acessa parametros via argumentos em métodos
 * mas sim via valores injetados nas propriedades da instância
 * As variaveis da requisição são automaticamente importadas para dentro da instância
 * Mas são apenas importadas quando a classe declara tais variáveis como públicas
*/
abstract class Base{
	
	function __construct($request_data=null){
		// importa variaveis do array $request_data ou da variável de requisição padrão
		$request_data = is_array($request_data) ? $request_data : $_REQUEST;
		foreach($request_data as $k => $v){
			if(property_exists($this,$k)){
				$this->$k = $v;		
			}
		}
		// inicializações da classe concreta
		$this->init();
	}
	
	function init(){
		// sobrescreva init ao invés de __construct		
	}
	
	function index(){
		return 'Nada a ser apresentado : (';
	}
	
}
