<?php
require_once(__DIR__.'/config.php');
///////////////////////////////////////////////////////////////////////////////////////////
/**
 * 28/10/2015 21h
 * Ponto de partida da aplicação
 * Script desenvolvido apenas para execução dos testes aplicados pela MMDA
 * Veja o teste aqui: https://github.com/mmdadigital/test_php
 
 * Todas as requisições de página da aplicação devem passar por este script
 * A variável de requisição apontada por ACTION_VARNAME é utilizada para determinar qual ação deve ser executada
 * As ações ficam definidas dentro do array $routes abaixo
*/
///////////////////////////////////////////////////////////////////////////////////////////
$routes = array(
	// ID da Ação   		=> array(Controller , Metodo)
	'intro'                 => array('Test', 'index'),
	'gera_menu'     		=> array('Test', 'gera_menu'),
	'imovel'        		=> array('Portal', 'imovel'),
	'admin_imoveis' 		=> array('Admin' , 'index'),
	'admin_imovel'  		=> array('Admin' , 'imovel'),
	'admin_contatos'		=> array('Admin' , 'contatos'),
	'admin_contato'			=> array('Admin' , 'contato'),
	'admin_tipos'   		=> array('Admin' , 'tipos'),
	'admin_imovel_fotos'    => array('Admin' , 'imovel_fotos'),
	'admin_imovel_contatos' => array('Admin' , 'imovel_contatos'),
	'admin_contato_emails'  => array('Admin' , 'contato_emails'),
	'admin_contato_fones'   => array('Admin' , 'contato_fones'),
	
);
/////////////////////////////////////////////////////////////////////////////////////////
// Habilita/desabilita exibição de erros
if(DEV_MODE){
	error_reporting(E_ALL);
	ini_set('display_errors','1');	
} else {
	error_reporting(0);
	ini_set('display_errors','0');
}
//////////////////////////////////////////////////////////////////////////////////////////
// Determina qual ação foi solicitada
$action = null;
if(isset($_REQUEST[ACTION_VARNAME])){
	$action = $_REQUEST[ACTION_VARNAME];
}
if(is_null($action) || !isset($routes[$action])){
	$action = DEFAULT_ACTION;
}
//////////////////////////////////////////////////////////////////////////////////////////
// Inicializa o Controller necessário para executar a ação solicitada
$controller = $routes[$action][0];
$method = $routes[$action][1];
require_once(__DIR__.'/controllers/'.$controller.'.php');
$controller_class = "\\Controllers\\$controller";
$controllerObject = new $controller_class( $vars = $_REQUEST );
////////////////////////////////////////////////////////////////////////////////////////////
// Executa a ação, caso seja válida, do contrário executa o método index() padrão
if(!method_exists($controllerObject, $method)){
	$method = 'index';
}
$output = $controllerObject->$method();
////////////////////////////////////////////////////////////////////////////////////////////
// Printa a saída
echo $output;