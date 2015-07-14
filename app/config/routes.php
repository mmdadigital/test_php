<?php

//routes for the application

$routes['default'] = "site/index";

$routes['menu'] = "site/menuExample";

$routes['imobiliaria'] = "realty/index";
$routes['imobiliaria/'] = "realty/index";

$routes['imobiliaria/imovel/(var)'] = "realty/detail/$1";


?>