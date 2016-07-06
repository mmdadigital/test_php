<?php
namespace Application\Controller\Provider;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class Admin implements ControllerProviderInterface {
  public function connect(Application $app) {
    $admin = $app['controllers_factory'];

    $admin->get('/login',                  'Application\\Controller\\AdminController::login'); // TODO
    $admin->post('/login',                 'Application\\Controller\\AdminController::auth'); // TODO
    $admin->get('/dashboard',              'Application\\Controller\\AdminController::index'); // TODO

    /** Imóveis */
    $admin->get('/realties/add',           'Application\\Controller\\AdminController::addRealty')->bind('addrealty');
    $admin->get('/realties/edit/{realty}', 'Application\\Controller\\AdminController::editRealty');
    $admin->post('/realties/save',         'Application\\Controller\\AdminController::saveRealty')->bind('realtysave');

    /** Contatos */
    $admin->get('/contacts/add',           'Application\\Controller\\AdminController::addContact')->bind('addcontact');
    $admin->get('/contacts/edit/{contact}','Application\\Controller\\AdminController::editContact');
    $admin->post('/contacts/save',         'Application\\Controller\\AdminController::saveContact')->bind('contactsave');

    return $admin;
  }
}
