<?php
namespace Application\View;
use Symfony\Component\HttpFoundation\Request;
use Application\Helpers\Helper;
use Application\Repository;
use Application\Providers as Provider;

class Realty extends Provider\AbstractClass {
  public function addForm($id = 0) {
    Helper::$app = $this->app;
    $this->app['assets']->addAsset('js', 'jquery-3.0.0.min.js');
    $this->app['assets']->addAsset('js', 'form.js');

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
            'label' => 'Endereço'
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

  public function getPage($id) {
    Helper::$app           = $this->app;
    $realtyRepository      = new Repository\Realty($this->app['db']);
    $pictureRepository     = new Repository\PictureIndex($this->app['db']);
    $realty                = Helper::prepareCollection(array($realtyRepository->load($id)));
    $realty[0]['pictures'] = $pictureRepository->loadCollection($id);
    $realty[0]['related']  = Helper::getRelatedRealties('region', $realty[0]);

    return $this->app['twig']->render('realty.twig', array('realty' => $realty[0]));
  }
}
