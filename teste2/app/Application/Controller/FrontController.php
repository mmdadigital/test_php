<?php
namespace Application\Controller;
use Silex\Application;
use Application\View as View;

class FrontController {
  public function index(Application $app) {
    $view = new View\RealtyList($app);

    return $view->getPage();
  }

  public function realty(Application $app, $id) {
    $view = new View\Realty($app);

    return $view->getPage($id);
  }
}
