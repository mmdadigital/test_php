<?php
namespace Application\Helpers;
use Application\Entity;
use Application\Repository;

class Helper {
  public static $app;

  public static function savePictures($files, $captions, $realtyId) {
    $total = count($files['pictures']);

    for ($i = 0; $i < $total; $i++) {
      $file        = $files['pictures'][$i]['picture'];
      $newFilename = uniqid().'--'.$file->getClientOriginalName();
      $finalSrc    = 'images/'.$newFilename;

      if ($file->move(ROOT.'/images', $newFilename)) {
        $pictureEntity = new Entity\Picture;

        $pictureEntity->setPicture($finalSrc);
        $pictureEntity->setCaption($captions[$i]['caption']);
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

  public static function fieldCollection($fieldname = '') {
    if (!$fieldname) return array();

    switch ($fieldname) {
      case 'realty_pictures':
        $collection = array(
          'fields' => array(
            array(
              'picture' => array(
                'type'  => 'file',
                'label' => 'Imagem'
              ),
              'caption' => array(
                'type'  => 'text',
                'label' => 'Legenda'
              ),
              'add_picture' => array(
                'type'  => 'button',
                'label' => 'Adicionar Imagem'
              ),
            ),
          ),
        );
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
        $collection = array(
          'fields' => array(
            array(
              'name' => array(
                'type'  => 'text',
                'label' => 'Nome'
              ),
              'phones' => array(
                'type'       => 'multiple',
                'label'      => 'Telefones',
                'collection' => self::fieldCollection('phones'),
              ),
              'emails' => array(
                'type'       => 'multiple',
                'label'      => 'Emails',
                'collection' => self::fieldCollection('emails'),
              ),
              'add_contact' => array(
                'type'  => 'button',
                'label' => 'Adicionar contato',
              ),
              'remove_contact' => array(
                'type'  => 'button',
                'label' => 'Remover contato',
              ),
            ),
          )
        );
      break;
    }

    return $collection;
  }
}
