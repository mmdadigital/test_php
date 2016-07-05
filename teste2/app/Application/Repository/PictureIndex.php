<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;
use Application\Entity;

class PictureIndex {
  protected $db;
  protected $table;

  public function __construct(Connection $db) {
    $this->db    = $db;
    $this->table = 'picture_index';
  }

  public function save($pictureIndex) {
    $pictureIndexData = array(
      'realty_id'  => $pictureIndex->getRealtyId(),
      'picture_id' => $pictureIndex->getPictureId(),
      'updated_at' => $pictureIndex->getUpdatedAt(),
    );

    if ($pictureIndex->getId()) {
      $this->db->update($this->table, $pictureIndexData, array('id' => $pictureIndex->getId()));
    }
    else {
      $pictureIndexData['created_at'] = $pictureIndex->getCreatedAt();

      $this->db->insert($this->table, $pictureIndexData);

      $id = $this->db->lastInsertId();

      $pictureIndex->setId($id);
    }

    return $pictureIndex->getId();
  }

  public function loadCollection($realtyId) {
    $query = "SELECT DISTINCT pi.picture_id, pi.id, rp.picture, rp.caption
              FROM $this->table as pi
              JOIN realty_pictures as rp ON rp.id = pi.picture_id
              WHERE pi.realty_id = $realtyId";

    $pictures = $this->db->fetchAll($query);

    return $pictures;
  }

  public function delete($ids = array()) {
    if (empty($ids)) return;

    $query = "DELETE FROM $this->table WHERE id IN (?)";

    $this->db->executeQuery($query, array($ids), array(\Doctrine\DBAL\Connection::PARAM_INT_ARRAY));
  }
}
