<?php
use Silex\Provider\FormServiceProvider;

define('ROOT', __DIR__);
define('APP_URL', 'http://localhost.testephp/teste2/app');

// Starting Application
$app = new Silex\Application();

// Debug mode
$app['debug'] = true;

// Use Twig Template Engine
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path'    => __DIR__.'/Views',
  'twig.options' => array('autoescape' => false),
));

// Enable Session State
$app->register(new Silex\Provider\SessionServiceProvider());

// URL Generator
$app->register(new Silex\Provider\RoutingServiceProvider());

// Doctrine DBAL (Database connection)
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
  'db.options' => array(
    'driver'   => 'pdo_mysql',
    'dbname'   => 'teste2',
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => 'root',
    'charset'  => 'utf8'
  ),
));

// Extend Twig
new Application\Extensions\TwigForm($app);

// Application Routes
require_once __DIR__.'/routes.php';

// Run Application
$app->run();
