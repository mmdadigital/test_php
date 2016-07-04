<?php
namespace Application\View;
use Symfony\Component\HttpFoundation\Request;
use Application\Helpers\Helper;
use Application\Providers as Provider;

class Realty extends Provider\View {
  public function addForm() {
    $form = array(
      'form' => array(
        'name' => 'add-realty-form',
        'attributes' => array(
          'class'  => 'add-realty-form',
          'action' => $this->app['url_generator']->generate('realtysave')
        ),
        'elements' => array(
          'realty_type' => array(
            'type'    => 'select',
            'label'   => 'Número',
            'options' => array('tipo' => 'Tipo')
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

    return $this->app['twig']->render('add-realty-form.twig', $form);
  }
}
