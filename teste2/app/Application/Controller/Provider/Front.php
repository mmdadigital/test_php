<?php
namespace Application\Controller\Provider;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;

/**
 * Front controller provider
 * Provide controllers for application front routes.
 */
class Front implements ControllerProviderInterface {
  /**
   * Connect mounted routes.
   * @param  object $app   Main Application instance.
   * @return object $front Return all routes defined by this mount.
   */
  public function connect(Application $app) {
    $front = $app['controllers_factory'];

    $front->get('/login',       'Application\\Controller\\FrontController::login')->bind('login');
    $front->get('/',            'Application\\Controller\\FrontController::index')->bind('realtylist');
    $front->get('/imovel/{id}', 'Application\\Controller\\FrontController::realty')->bind('realtyview');

    return $front;
  }
}
