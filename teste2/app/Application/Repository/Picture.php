<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;
use Application\Entity;

class Picture {
  protected $db;

  public function __construct(Connection $db) {
    $this->db = $db;
  }

  public function save($picture) {
    $pictureData = array(
      'picture'    => $picture->getPicture(),
      'caption'    => $picture->getCaption(),
      'status'     => $picture->getStatus(),
      'updated_at' => $picture->getUpdatedAt(),
    );

    if ($picture->getId()) {
      $this->db->update('realty_pictures', $pictureData, array('id' => $picture->getId()));
    }
    else {
      $pictureData['created_at'] = $picture->getCreatedAt();

      $this->db->insert('realty_pictures', $pictureData);

      $id = $this->db->lastInsertId();

      $picture->setId($id);
    }

    return $picture->getId();
  }
}
