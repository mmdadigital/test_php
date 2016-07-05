<?php
namespace Application\View;
use Symfony\Component\HttpFoundation\Request;
use Application\Helpers\Helper;
use Application\Repository;
use Application\Providers as Provider;

class Realty extends Provider\AbstractClass {
  public function addForm($id = 0) {
    Helper::$app = $this->app;

    $form = array(
      'form' => array(
        'name'  => 'add-realty-form',
        'title' => 'Imóvel',
        'attributes' => array(
          'class'   => 'add-realty-form',
          'action'  => $this->app['url_generator']->generate('realtysave'),
          'method'  => 'POST',
          'enctype' => 'multipart/form-data'
        ),
        'elements' => array(
          'realty_type' => array(
            'type'    => 'select',
            'label'   => 'Tipo de imóvel',
            'options' => Helper::realtyTypes()
          ),
          'address' => array(
            'type'  => 'text',
            'label' => 'Rua'
          ),
          'number' => array(
            'type'  => 'text',
            'label' => 'Número'
          ),
          'city' => array(
            'type'  => 'text',
            'label' => 'Cidade'
          ),
          'region' => array(
            'type'    => 'select',
            'label'   => 'Estado',
            'options' => Helper::regions()
          ),
          'description' => array(
            'type'  => 'textarea',
            'label' => 'Descrição'
          ),
          'pictures' => array(
            'type'       => 'multiple',
            'label'      => 'Fotos',
            'collection' => Helper::fieldCollection('realty_pictures')
          ),
          'contacts' => array(
            'type'       => 'multiple',
            'label'      => 'Contatos',
            'collection' => Helper::fieldCollection('contacts')
          ),
          'save' => array(
            'type'  => 'submit',
            'label' => 'Salvar',
          ),
        ),
      )
    );

    if ($id) {
      $realtyRepository = new Repository\Realty($this->app['db']);
      $realty           = $realtyRepository->load($id[0]);
      $form             = Helper::populateForm($form, $realty);
    }

    return $this->app['twig']->render('add-form.twig', $form);
  }
}
