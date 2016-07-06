<?php
namespace Application\View;
use Symfony\Component\HttpFoundation\Request;
use Application\Helpers\Helper;
use Application\Providers as Provider;

class Login extends Provider\AbstractClass {
  public function addForm() {
    $request     = Request::createFromGlobals();
    Helper::$app = $this->app;

    $form = array(
      'error'         => $this->app['security.last_error']($request),
      'last_username' => $this->app['session']->get('_security.last_username'),
      'form'          => array(
        'name'  => 'login-form',
        'title' => 'Login',
        'attributes' => array(
          'class'   => 'login-form',
          'method'  => 'POST',
        ),
        'elements' => array(
          '_username' => array(
            'type'    => 'text',
            'label'   => 'Nome de usuário',
            'value'   => $this->app['session']->get('_security.last_username'),
          ),
          '_password' => array(
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
