<?php
namespace Application\Controller\Provider;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class Admin implements ControllerProviderInterface {
  public function connect(Application $app) {
    $admin = $app['controllers_factory'];

    $admin->get('/login', 'Application\\Controller\\AdminController::login'); // TODO
    $admin->post('/login', 'Application\\Controller\\AdminController::auth'); // TODO
    $admin->get('/dashboard', 'Application\\Controller\\AdminController::index'); // TODO
    $admin->get('/realties', 'Application\\Controller\\AdminController::index'); // TODO
    $admin->get('/realties/add', 'Application\\Controller\\AdminController::addRealty');
    $admin->post('/realties/save', 'Application\\Controller\\AdminController::saveRealty')->bind('realtysave'); // DOING

    return $admin;
  }
}
