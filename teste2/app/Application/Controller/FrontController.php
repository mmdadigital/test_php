<?php
namespace Application\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Application\View as View;

/**
 * Admin controller
 * All the Application admin actions.
 */
class FrontController {
  /**
   * Home page action
   * @param object $app   Main Application instance.
   */
  public function index(Application $app) {
    $view = new View\RealtyList($app);

    return $view->getPage();
  }

  /**
   * Login page action
   * @param  object $app   Main Application instance.
   * @return string $front Return the view with a login form
   */
  public function login(Application $app) {
    $view    = new View\Login($app);
    $form    = $view->getAddForm();

    return $form;
  }

  /**
   * Single realty page action
   * @param object $app Main Application instance.
   */
  public function realty(Application $app, $id) {
    $view = new View\Realty($app);

    return $view->getPage($id);
  }
}
