<?php
namespace Application\Helpers;
use Application\Entity;
use Application\Repository;

class Helper {
  public static $app;

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

  public static function realtyTypes() {
    $type           = new Repository\Type(self::$app['db']);
    $typeCollection = array(0 => '--Selecione--');

    foreach ($type->getCollection() as $type) {
      $typeCollection[$type['id']] = $type['type'];
    }

    return $typeCollection;
  }

  public static function realtyContacts() {
    $contactRepository = new Repository\Contact(self::$app['db']);
    $contactCollection = array(0 => '--Selecione--');

    foreach ($contactRepository->getCollection() as $contact) {
      $contactCollection[$contact['id']] = $contact['name'];
    }

    return $contactCollection;
  }

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
        $collection = array(
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
      break;

      case 'emails':
        $collection = array(
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
          $contacts          = $contactRepository->load($contactIds);
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

          case 'contacts':
            $identifier = $name;
          break;
        }

        $form['form']['elements'][$name]['collection'] = self::fieldCollection($identifier, $data);
      }
    }

    return $form;
  }
}
