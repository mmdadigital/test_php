<?php
namespace Application\View;
use Symfony\Component\HttpFoundation\Request;
use Application\Helpers\Helper;
use Application\Repository;
use Application\Providers as Provider;

/**
 * Contact view
 * Get and set all data before render a template
 */
class Contact extends Provider\AbstractClass {
  /**
   * Add a form to the view
   * @param integer $id Contact id
   */
  public function addForm($id = 0) {
    Helper::$app = $this->app;
    $this->app['assets']->addAsset('js', 'jquery-3.0.0.min.js');
    $this->app['assets']->addAsset('js', 'form.js');

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

    if ($id) {
      $contactRepository = new Repository\Contact($this->app['db']);
      $contact           = $contactRepository->load($id[0]);
      $form              = Helper::populateForm($form, $contact);
    }

    return $this->app['twig']->render('add-form.twig', $form);
  }
}
