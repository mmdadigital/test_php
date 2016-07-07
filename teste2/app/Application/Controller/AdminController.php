<?php
namespace Application\Controller;
use Silex\Application;
use Application\View as View;
use Application\Repository;
use Application\Entity;
use Application\Helpers\Helper;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller
 * All the Application admin actions.
 */
class AdminController {
  /**
   * Authentication route
   */
  public function auth($data) {
    return 'ok';
  }

  /**
   * Add realty form
   * @param  object $app   Main Application instance.
   * @return object $front Return the view with a form
   */
  public function addRealty(Application $app) {
    $view = new View\Realty($app);
    $form = $view->getAddForm();

    return $form;
  }

  /**
   * Edit realty form
   * @param  object  $app    Main Application instance.
   * @param  integer $realty Realty id.
   * @return object  $front  Return the view with a form with loaded realty data
   */
  public function editRealty(Application $app, $realty) {
    $view = new View\Realty($app);
    $form = $view->getAddForm($realty);

    return $form;
  }

  /**
   * Add contact form
   * @param  object $app   Main Application instance.
   * @return object $front Return the view with a form
   */
  public function addContact(Application $app) {
    $view = new View\Contact($app);
    $form = $view->getAddForm();

    return $form;
  }

  /**
   * Edit contact form
   * @param  object  $app     Main Application instance.
   * @param  integer $contact Contact id.
   * @return object  $front   Return the view with a form with loaded contact data
   */
  public function editContact(Application $app, $contact) {
    $view = new View\Contact($app);
    $form = $view->getAddForm($contact);

    return $form;
  }

  /**
   * Save a realty to the database
   * @param object $app Main Application instance.
   */
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

    if(isset($realtyInput['id'])) {
      $realtyEntity->setId($realtyInput['id']);
    }

    if (isset($realtyInput['picture_delete'])) {
      $ids = array();

      foreach ($realtyInput['picture_delete'] as $key => $value) {
        array_push($ids, $value);
      }

      $pictureIndexRepository = new Repository\PictureIndex($app['db']);
      $pictureIndexRepository->delete($ids);
    }

    if (isset($realtyInput['contact_delete'])) {
      Helper::$app = $app;
      Helper::saveMultiple($realtyInput['contacts'], $realtyInput['id']);
    }

    if ($realtyId = $realtyRepository->save($realtyEntity)) {
      Helper::$app = $app;

      if ($files = $request->files->all()) {
        Helper::savePictures($files, $realtyInput['pictures'], $realtyId);
      }

      Helper::saveMultiple($realtyInput['contacts'], $realtyId);

      return $app->redirect($app['url_generator']->generate('addrealty'));
    }
  }

  /**
   * Save a contact to the database
   * @param object $app Main Application instance.
   */
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

    if (isset($contactInput['id'])) {
      $contactEntity->setId($contactInput['id']);
    }

    if($contactRepository->save($contactEntity)) {
      return $app->redirect($app['url_generator']->generate('addcontact'));
    }
  }
}
