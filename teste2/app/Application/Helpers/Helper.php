<?php
namespace Application\Helpers;
use Application\Entity;
use Application\Repository;

/**
 * Helper methods
 * Provide common methods through the Application.
 */
class Helper {
  public static $app;

  /**
   * Save realty pictures
   * @param array   $files    Array of file name to save.
   * @param array   $captions Array of captions to save.
   * @param integer $realtyId Realty which images belong to.
   */
  public static function savePictures($files, $captions, $realtyId) {
    foreach ($files['pictures'] as $key => $value) {
      $file        = $value['picture'];
      $newFilename = uniqid().'--'.$file->getClientOriginalName();
      $finalSrc    = 'images/'.$newFilename;

      if ($file->move(ROOT.'/images', $newFilename)) {
        $pictureEntity = new Entity\Picture;

        $pictureEntity->setPicture($finalSrc);
        $pictureEntity->setCaption($captions[$key]['caption']);
        $pictureEntity->setStatus(1);
        $pictureEntity->setCreatedAt();
        $pictureEntity->setUpdatedAt();

        $pictureRepository = new Repository\Picture(self::$app['db']);

        if ($pictureId = $pictureRepository->save($pictureEntity)) {
          $pictureIndexEntity = new Entity\PictureIndex;

          $pictureIndexEntity->setRealtyId($realtyId);
          $pictureIndexEntity->setPictureId($pictureId);
          $pictureIndexEntity->setCreatedAt();
          $pictureIndexEntity->setUpdatedAt();

          $pictureIndexRepository = new Repository\PictureIndex(self::$app['db']);
          $pictureIndexRepository->save($pictureIndexEntity);
        }
      }
    }
  }

  /**
   * Save multiple fields
   * @param array   $fields   Array of fields to save.
   * @param integer $realtyId Realty which images belong to.
   */
  public static function saveMultiple($fields, $realtyId) {
    $realtyEntity = new Entity\Realty;
    $ids          = array();

    foreach ($fields as $field) {
      array_push($ids, $field['name']);
    }

    $realtyEntity->setId($realtyId);
    $realtyEntity->setContacts(json_encode($ids));

    $realtyRepository = new Repository\Realty(self::$app['db']);
    $realtyRepository->save($realtyEntity);
  }

  /**
   * Get realty types list
   */
  public static function realtyTypes() {
    $type           = new Repository\Type(self::$app['db']);
    $typeCollection = array(0 => '--Selecione--');

    foreach ($type->getCollection() as $type) {
      $typeCollection[$type['id']] = $type['type'];
    }

    return $typeCollection;
  }

  /**
   * Get realty all contacts list
   */
  public static function realtyContacts() {
    $contactRepository = new Repository\Contact(self::$app['db']);
    $contactCollection = array(0 => '--Selecione--');

    foreach ($contactRepository->getCollection() as $contact) {
      $contactCollection[$contact['id']] = $contact['name'];
    }

    return $contactCollection;
  }

  /**
   * Get regions
   */
  public static function regions() {
    return array(
      "AC" => "Acre",
      "AL" => "Alagoas",
      "AM" => "Amazonas",
      "AP" => "Amapá",
      "BA" => "Bahia",
      "CE" => "Ceará",
      "DF" => "Distrito Federal",
      "ES" => "Espírito Santo",
      "GO" => "Goiás",
      "MA" => "Maranhão",
      "MT" => "Mato Grosso",
      "MS" => "Mato Grosso do Sul",
      "MG" => "Minas Gerais",
      "PA" => "Pará",
      "PB" => "Paraíba",
      "PR" => "Paraná",
      "PE" => "Pernambuco",
      "PI" => "Piauí",
      "RJ" => "Rio de Janeiro",
      "RN" => "Rio Grande do Norte",
      "RO" => "Rondônia",
      "RS" => "Rio Grande do Sul",
      "RR" =>"Roraima",
      "SC" => "Santa Catarina",
      "SE" => "Sergipe",
      "SP" => "São Paulo",
      "TO" => "Tocantins"
    );
  }

  /**
   * Get a field collection array
   * @param string $fieldname Field collection name.
   * @param array  $data      Field data.
   */
  public static function fieldCollection($fieldname = '', $data = null) {
    if (!$fieldname) return array();

    switch ($fieldname) {
      case 'realty_pictures':
        $defaultFields = $collection = array(
          'fields' => array(
            array(
              'picture' => array(
                'type'  => 'file',
                'label' => 'Imagem',
                'value' => ''
              ),
              'caption' => array(
                'type'  => 'text',
                'label' => 'Legenda',
                'value' => ''
              ),
              'add_picture' => array(
                'type'  => 'button',
                'label' => 'Adicionar Imagem'
              ),
              'remove_picture' => array(
                'type'  => 'button',
                'label' => 'Remover Imagem'
              ),
            ),
          ),
        );

        if ($data) {
          $pictureRepository = new Repository\PictureIndex(self::$app['db']);
          $pictures          = $pictureRepository->loadCollection($data['id']);

          if (empty($pictures)) {
            $collection = $defaultFields;
          }
          else {
            $collection = array('fields' => array());

            foreach ($pictures as $key => $value) {
              $collection['fields'][$key] = array(
                'picture'        => array(
                  'type'         => 'text',
                  'label'        => 'Imagem',
                  'value'        => $value['picture'],
                  'disabled'     => true,
                  'image_render' => true
                ),
                'caption' => array(
                  'type'  => 'text',
                  'label' => 'Legenda',
                  'value' => $value['caption'],
                ),
                'add_picture' => array(
                  'type'  => 'button',
                  'label' => 'Adicionar Imagem'
                ),
                'remove_picture' => array(
                  'type'    => 'button',
                  'label'   => 'Remover Imagem',
                  'data_id' => $value['id']
                ),
              );
            }
          }
        }
        else {
          $collection = $defaultFields;
        }
      break;

      case 'phones':
        $defaultFields = array(
          'fields' => array(
            array(
              'phone' => array(
                'type'  => 'text',
                'label' => 'Telefone'
              ),
              'add_phone' => array(
                'type'  => 'button',
                'label' => 'Adicionar telefone'
              ),
              'remove_phone' => array(
                'type'  => 'button',
                'label' => 'Remover telefone'
              ),
            ),
          ),
        );

        if ($data) {
          $phones = json_decode($data['phones']);

          foreach ($phones as $key => $phone) {
            $collection['fields'][$key] = array(
              'phone' => array(
                'type'  => 'text',
                'label' => 'Telefone',
                'value' => $phone->phone,
                'index' => $key
              ),
              'add_phone' => array(
                'type'  => 'button',
                'label' => 'Adicionar telefone',
              ),
              'remove_phone' => array(
                'type'    => 'button',
                'label'   => 'Remover telefone',
                'data_id' => $key,
              ),
            );
          }
        }
        else {
          $collection = $defaultFields;
        }
      break;

      case 'emails':
        $defaultFields = array(
          'fields' => array(
            array(
              'email' => array(
                'type'  => 'text',
                'label' => 'Email'
              ),
              'add_email' => array(
                'type'  => 'button',
                'label' => 'Adicionar email'
              ),
              'remove_email' => array(
                'type'  => 'button',
                'label' => 'Remover email'
              ),
            ),
          )
        );

        if ($data) {
          $emails = json_decode($data['emails']);

          foreach ($emails as $key => $email) {
            $collection['fields'][$key] = array(
              'email' => array(
                'type'  => 'text',
                'label' => 'Email',
                'value' => $email->email,
                'index'   => $key
              ),
              'add_email' => array(
                'type'  => 'button',
                'label' => 'Adicionar email',
              ),
              'remove_email' => array(
                'type'    => 'button',
                'label'   => 'Remover email',
                'data_id' => $key,
              ),
            );
          }
        }
        else {
          $collection = $defaultFields;
        }
      break;

      case 'contacts':
        $defaultFields = $collection = array(
          'fields' => array(
            array(
              'name' => array(
                'type'    => 'select',
                'label'   => 'Nome',
                'options' => self::realtyContacts()
              ),
              'add_contact' => array(
                'type'  => 'button',
                'label' => 'Adicionar Contato'
              ),
              'remove_contact' => array(
                'type'  => 'button',
                'label' => 'Remover Contato'
              ),
            ),
          )
        );

        if ($data) {
          $contactRepository = new Repository\Contact(self::$app['db']);
          $contactIds        = json_decode(json_decode($data['contacts']));
          $contacts          = $contactRepository->loadMultiple($contactIds);
          $collection        = array('fields' => array());

          if ($contactIds[0] == 0) {
            $collection = $defaultFields;
          }
          else {
            foreach ($contacts as $key => $contact) {
              $collection['fields'][$key] = array(
                'name' => array(
                  'type'    => 'select',
                  'label'   => 'Nome',
                  'options' => self::realtyContacts(),
                  'value'   => $contact['id'],
                  'index'   => $key
                ),
                'add_contact' => array(
                  'type'  => 'button',
                  'label' => 'Adicionar Contato'
                ),
                'remove_contact' => array(
                  'type'    => 'button',
                  'label'   => 'Remover Contato',
                  'data_id' => $contact['id']
                ),
              );
            }
          }
        }
        else {
          $collection = $defaultFields;
        }
      break;
    }

    return $collection;
  }

  /**
   * Populate a form with provided data
   * @param array $form Form array.
   * @param array $data Form data.
   */
  public static function populateForm($form, $data) {
    foreach ($form['form']['elements'] as $name => $field) {
      $form['form']['elements']['id'] = array(
        'type'  => 'hidden',
        'value' => $data['id'],
        'label' => ''
      );

      if ($field['type'] !== 'multiple') {
        $form['form']['elements'][$name]['value'] = isset($data[$name]) ? $data[$name] : '';
      }
      else {
        switch ($name) {
          case 'pictures':
            $identifier = 'realty_pictures';
          break;

          default:
            $identifier = $name;
          break;
        }

        $form['form']['elements'][$name]['collection'] = self::fieldCollection($identifier, $data);
      }
    }

    return $form;
  }

  /**
   * Prepare a collection of items populating encoded data
   * @param array $form The item collection.
   */
  public static function prepareCollection($collection) {
    foreach ($collection as $key => $item) {
      if (isset($item['contacts'])) {
        $contactRepository            = new Repository\Contact(self::$app['db']);
        $ids                          = json_decode(json_decode($item['contacts']));
        $contacts                     = self::prepareCollection($contactRepository->loadMultiple($ids));
        $collection[$key]['contacts'] = $contacts;
      }

      if (isset($item['phones'])) {
        $phones                     = json_decode($item['phones']);
        $collection[$key]['phones'] = $phones;
      }

      if (isset($item['emails'])) {
        $emails                     = json_decode($item['emails']);
        $collection[$key]['emails'] = $emails;
      }
    }

    return $collection;
  }

  /**
   * Get realties related to another realty, filtering by a common field
   * @param string  $field Field name.
   * @param integer $realty Realty id.
   */
  public static function getRelatedRealties($field, $realty) {
    $realtyRepository  = new Repository\Realty(self::$app['db']);
    $pictureRepository = new Repository\PictureIndex(self::$app['db']);
    $relatedRealties   = self::prepareCollection($realtyRepository->getByField($field, $realty[$field]));
    $relatedRealties   = self::getPictures($relatedRealties);

    return $relatedRealties;
  }

  /**
   * Get picutes form a list of realties
   * @param array   $realties List of realties.
   */
  public static function getPictures($realties) {
    $pictureRepository = new Repository\PictureIndex(self::$app['db']);

    foreach ($realties as $key => $realty) {
      $realties[$key]['pictures'] = $pictureRepository->loadCollection($realty['id']);
    }

    return $realties;
  }
}
