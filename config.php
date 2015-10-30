<?php
/**
 * 28/10/2015 22h
 * Define constantes utilizadas por toda a aplicação
*/
define('DEV_MODE',true); // Aqui poderia ser algo do tipo getenv('dev');

if(DEV_MODE){ // desenvolvimento

	define('BASE_URL','http://localhost/');
	define('IMG_BASE_URL','http://localhost/imgs/');
	define('IMG_DIR',__DIR__.'/imgs/');
	define('ACTION_VARNAME', 'a');
	define('DEFAULT_ACTION', 'intro');

	define('DB_HOST_DEFAULT', 'localhost');
	define('DB_USER_DEFAULT', 'root');
	define('DB_PASS_DEFAULT', '');
	define('DB_NAME_DEFAULT', 'test_php');

} else { // produção
	
	define('BASE_URL','http://localhost/');
	define('IMG_BASE_URL','http://localhost/imgs/');
	define('IMG_DIR',__DIR__.'/imgs/');
	define('ACTION_VARNAME', 'a');
	define('DEFAULT_ACTION', 'intro');

	define('DB_HOST_DEFAULT', 'localhost');
	define('DB_USER_DEFAULT', 'root');
	define('DB_PASS_DEFAULT', '');
	define('DB_NAME_DEFAULT', 'test_php');

	
}
