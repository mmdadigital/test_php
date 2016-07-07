<?php
namespace Application\Controller\Provider;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;

/**
 * Admin controller provider
 * Provide controllers for application admin routes.
 */
class Admin implements ControllerProviderInterface {
  /**
   * Connect mounted routes.
   * @param  object $app   Main Application instance.
   * @return object $front Return all routes defined by this mount.
   */
  public function connect(Application $app) {
    $admin = $app['controllers_factory'];

    /** Authentication */
    $admin->post('/auth',                  'Application\\Controller\\AdminController::auth')->bind('auth');

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
