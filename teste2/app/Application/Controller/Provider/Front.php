<?php
namespace Application\Controller\Provider;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class Front implements ControllerProviderInterface {
  public function connect(Application $app) {
    $front = $app['controllers_factory'];

    $front->get('/', 'Application\\Controller\\FrontController::index')->bind('realtylist');
    $front->get('/imovel/{id}', 'Application\\Controller\\FrontController::realty')->bind('realtyview');

    return $front;
  }
}
