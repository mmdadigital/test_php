<?php 
	
	//require config files
	require_once APP_PATH.'config/config.php';
	require_once APP_PATH.'config/routes.php';
	require_once APP_PATH.'config/menu.php';
	require_once APP_PATH.'config/database.php';
	

	//get current route paramater
	$user_route = str_replace($config['base'],'', $_SERVER['REQUEST_URI']);




	//define $user_route as the parameter to execute or default if it's the index
	if($user_route==""){
		$request = 'default';
	}else{
		$request = $user_route;
	}


	//get parameters to run the app
	if(isset($routes[$request])){
		$route_parameters = explode('/',$routes[$request]);
		$param = null;
	}else{
		//if the route is not a simple route, defines the correct class and method to execute and set the paramater to pass to the method
		foreach ($routes as $key => $value){
			$routeArray = explode('/',$key); //explodes for comparassion
			$requestArray = explode ('/',$request); //explodes for comparassion
			if(in_array("(var)", $routeArray)){ //test if its really a dinamic route
				$route_parameters = explode('/',$value); 
				if(($requestArray[0]==$routeArray[0])&&($requestArray[1]==$routeArray[1])){ //make sure that it will run the correct method from the correct class
					$param = $requestArray[2]; //define the third element of the route as parameter (current limitation)
				}
			}
		}
	}

	$class = $route_parameters[0]; //class name to call in object
	$function = $route_parameters[1]; //function to execute

	//require main controller file
	require_once APP_PATH.'core/controller.php';

	//require main model file
	require_once APP_PATH.'core/model.php';

	//initializate the database
	$pdo = new PDO("mysql:host=".$database['host'].";dbname=".$database['db_name'],$database['user'],$database['pass']);

	//get controller file to the route
	require_once APP_PATH.'controllers/'.$class.'.php';

	//instantiate the object from the route class
	$controller = new $class;

	//set database settings
	$controller->database = $pdo;

	//set menu itens to the app
	$controller->menu_array = $menu;
	
	//set base url 
	$controller->base_url = "http://".$_SERVER['HTTP_HOST'].$config['base'];

	//execute the route method
	$controller->$function($param);

?>