<?php
namespace Application\View;
use Symfony\Component\HttpFoundation\Request;
use Application\Helpers\Helper;
use Application\Providers as Provider;

class Login extends Provider\AbstractClass {
  public function addForm() {
    Helper::$app = $this->app;

    $form = array(
      'form' => array(
        'name'  => 'login-form',
        'title' => 'Login',
        'attributes' => array(
          'class'   => 'login-form',
          'action'  => $this->app['url_generator']->generate('auth'),
          'method'  => 'POST',
        ),
        'elements' => array(
          'username' => array(
            'type'    => 'text',
            'label'   => 'Nome de usuário',
          ),
          'password' => array(
            'type'       => 'password',
            'label'      => 'Senha',
          ),
          'login' => array(
            'type'  => 'submit',
            'label' => 'Login',
          ),
        ),
      )
    );

    return $this->app['twig']->render('login-form.twig', $form);
  }
}
