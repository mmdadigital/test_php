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

  public function editRealty(Application $app, $realty) {
    $view = new View\Realty($app);
    $form = $view->getAddForm($realty);

    return $form;
  }

  public function addContact(Application $app) {
    $view = new View\Contact($app);
    $form = $view->getAddForm();

    return $form;
  }

  public function saveRealty(Application $app) {
    $request          = Request::createFromGlobals();
    $realtyInput      = $request->request->all();
    $realtyRepository = new Repository\Realty($app['db']);
    $realtyEntity     = new Entity\Realty;

    $realtyEntity->setRealtyType($realtyInput['realty_type']);
    $realtyEntity->setAddress($realtyInput['address']);
    $realtyEntity->setNumber($realtyInput['number']);
    $realtyEntity->setCity($realtyInput['city']);
    $realtyEntity->setRegion($realtyInput['region']);
    $realtyEntity->setDescription($realtyInput['description']);
    $realtyEntity->setCreatedAt();
    $realtyEntity->setUpdatedAt();

    if ($realtyId = $realtyRepository->save($realtyEntity)) {
      Helper::$app = $app;
      Helper::savePictures($request->files->all(), $realtyInput['pictures'], $realtyId);
      Helper::saveMultiple($realtyInput['contacts'], $realtyId);
    }
  }

  public function saveContact(Application $app) {
    $request           = Request::createFromGlobals();
    $contactInput      = $request->request->all();
    $contactRepository = new Repository\Contact($app['db']);
    $contactEntity     = new Entity\Contact;

    $contactEntity->setName($contactInput['name']);
    $contactEntity->setPhones($contactInput['phones']);
    $contactEntity->setEmails($contactInput['emails']);
    $contactEntity->setCreatedAt();
    $contactEntity->setUpdatedAt();

    return $contactRepository->save($contactEntity);
  }
}
