<?php
namespace Application\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Application\View as View;

class FrontController {
  public function index(Application $app) {
    $view = new View\RealtyList($app);

    return $view->getPage();
  }

  public function login(Application $app) {
    $view    = new View\Login($app);
    $form    = $view->getAddForm();

    return $form;
  }

  public function realty(Application $app, $id) {
    $view = new View\Realty($app);

    return $view->getPage($id);
  }
}
