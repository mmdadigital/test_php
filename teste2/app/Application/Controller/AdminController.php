<?php
namespace Application\Controller;
use Silex\Application;
use Application\View as View;
use Application\Repository;
use Application\Entity;
use Application\Helpers\Helper;
use Symfony\Component\HttpFoundation\Request;

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

  public function saveRealty(Application $app) {
    $request          = Request::createFromGlobals();
    $realtyInput      = $request->request->all();
    $realtyRepository = new Repository\Realty($app['db']);
    $realtyEntity     = new Entity\Realty;
    $contacts         = array(
      'contacts' => $realtyInput['contacts'],
      'phones'   => $realtyInput['phones'],
      'emails'   => $realtyInput['emails']
    );

    $realtyEntity->setRealtyType($realtyInput['realty_type']);
    $realtyEntity->setAddress($realtyInput['address']);
    $realtyEntity->setNumber($realtyInput['number']);
    $realtyEntity->setCity($realtyInput['city']);
    $realtyEntity->setRegion($realtyInput['region']);
    $realtyEntity->setDescription($realtyInput['description']);
    $realtyEntity->setContacts($contacts);
    $realtyEntity->setCreatedAt();
    $realtyEntity->setUpdatedAt();

    if ($realtyId = $realtyRepository->save($realtyEntity)) {
      Helper::$app = $app;
      Helper::savePictures($request->files->all(), $realtyInput['pictures'], $realtyId);
      Helper::saveMultiple($contacts, $realtyId);
    }
  }
}
