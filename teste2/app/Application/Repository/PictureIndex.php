<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;
use Application\Entity;

class PictureIndex {
  protected $db;

  public function __construct(Connection $db) {
    $this->db = $db;
  }

  public function save($pictureIndex) {
    $pictureIndexData = array(
      'realty_id'  => $pictureIndex->getRealtyId(),
      'picture_id' => $pictureIndex->getPictureId(),
      'updated_at' => $pictureIndex->getUpdatedAt(),
    );

    if ($pictureIndex->getId()) {
      $this->db->update('picture_index', $pictureIndexData, array('id' => $pictureIndex->getId()));
    }
    else {
      $pictureIndexData['created_at'] = $pictureIndex->getCreatedAt();

      $this->db->insert('picture_index', $pictureIndexData);

      $id = $this->db->lastInsertId();

      $pictureIndex->setId($id);
    }

    return $pictureIndex->getId();
  }
}
