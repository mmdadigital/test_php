<?php
namespace Application\View;
use Symfony\Component\HttpFoundation\Request;
use Application\Helpers\Helper;
use Application\Providers as Provider;

class Contact extends Provider\AbstractClass {
  public function addForm() {
    $form = array(
      'form' => array(
        'name'  => 'add-contact-form',
        'title' => 'Contato',
        'attributes' => array(
          'class'   => 'add-contact-form',
          'action'  => $this->app['url_generator']->generate('contactsave'),
          'method'  => 'POST',
        ),
        'elements' => array(
          'name' => array(
            'type'    => 'text',
            'label'   => 'Nome',
          ),
          'phones' => array(
            'type'       => 'multiple',
            'label'      => 'Telefones',
            'collection' => Helper::fieldCollection('phones')
          ),
          'emails' => array(
            'type'       => 'multiple',
            'label'      => 'Emails',
            'collection' => Helper::fieldCollection('emails')
          ),
          'save' => array(
            'type'  => 'submit',
            'label' => 'Salvar',
          ),
        ),
      )
    );

    return $this->app['twig']->render('add-form.twig', $form);
  }
}
