<?php
/** Application root path */
define('ROOT', __DIR__);

/** Application URL */
define('APP_URL', 'http://localhost.testephp/teste2/app');

/** Starting Application */
$app = new Silex\Application();

/** Debug mode */
$app['debug'] = true;

/** Template Engine */
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path'    => __DIR__.'/Application/Templates',
  'twig.options' => array('autoescape' => false),
));

/** URL Generator */
$app->register(new Silex\Provider\RoutingServiceProvider());

/** Database connection */
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

/** Assets */
$app['assets'] = new Application\Extensions\Assets($app);

/** Extending Twig */
new Application\Extensions\TwigForm($app);

/** Application Routes */
require_once __DIR__.'/routes.php';

/** Securing application */
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
  'security.firewalls' => array(
    'admin' => array(
      'pattern' => '^/admin/',
      'form' => array('login_path' => '/login', 'check_path' => '/admin/auth'),
      'users' => array(
        'admin' => array('ROLE_ADMIN', '$2y$10$3i9/lVd8UOFIJ6PAMFt8gu3/r5g0qeCJvoSlLCsvMTythye19F77a'),
      ),
    ),
  )
));

/** Run Application */
$app->run();
