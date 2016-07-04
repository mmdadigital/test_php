<?php
namespace Application\Controller;
use Silex\Application;
use Application\View as View;

class AdminController {
  public function login() {

    return 'Página de login';
  }

  public function auth($data) {
    return 'Post Login';
  }

  public function index() {
    return 'Painel';
  }

  public function addRealty(Application $app) {
    $view = new View\Realty($app);
    $form = $view->getAddForm();

    return $form;
  }

  public function saveRealty() {

  }
}
