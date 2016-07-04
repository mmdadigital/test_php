<?php
use Silex\Provider\FormServiceProvider;

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

// Extend Twig
new Application\Extensions\TwigForm($app);

// Application Routes
require_once __DIR__.'/routes.php';

// Run Application
$app->run();
