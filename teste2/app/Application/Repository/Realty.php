<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;
use Application\Helpers\Helper;

class Realty {
  protected $db;
  protected $table;

  public function __construct(Connection $db) {
    $this->db    = $db;
    $this->table = 'realties';
  }

  public function save($realty) {
    $realtyData = array(
      'realty_type' => $realty->getRealtyType(),
      'address'     => $realty->getAddress(),
      'number'      => $realty->getNumber(),
      'city'        => $realty->getCity(),
      'region'      => $realty->getRegion(),
      'description' => $realty->getDescription(),
      'contacts'    => $realty->getContacts(),
      'updated_at'  => $realty->getUpdatedAt(),
    );

    if ($realty->getId()) {
      $realtyData = $this->prepare($realtyData);

      $this->db->update($this->table, $realtyData, array('id' => $realty->getId()));
    }
    else {
      $realtyData['created_at'] = $realty->getCreatedAt();

      $this->db->insert($this->table, $realtyData);

      $id = $this->db->lastInsertId();

      $realty->setId($id);
    }

    return $realty->getId();
  }

  public function getCollection() {
    $query = "SELECT DISTINCT r.id, r.address, r.number, r.city, r.region, r.description, r.contacts, rt.type
              FROM $this->table as r
              JOIN realty_types as rt ON r.realty_type = rt.id
              JOIN picture_index as pi ON r.id = pi.realty_id";

    $types = $this->db->fetchAll($query);

    return $types;
  }

  public function load($id) {
    $query  = "SELECT r.id, r.address, r.number, r.city, r.region, r.description, r.contacts, rt.type
               FROM $this->table as r
               JOIN realty_types as rt on rt.id = r.realty_type
               JOIN picture_index as pi ON r.id = pi.realty_id
               WHERE r.id = $id";
    $realty = $this->db->fetchAssoc($query);

    return $realty;
  }

  public function getByField($field, $value, $limit = 3) {
    $query = "SELECT DISTINCT r.id, r.address, r.number, r.city, r.region, r.description, r.contacts, rt.type
               FROM $this->table as r
               JOIN realty_types as rt on rt.id = r.realty_type
               JOIN picture_index as pi ON r.id = pi.realty_id
               WHERE r.$field = '$value'
               LIMIT $limit";
    $types = $this->db->fetchAll($query);

    return $types;
  }

  protected function prepare($data) {
    foreach ($data as $key => $value) {
      if (!$value) {
        unset($data[$key]);
      }
    }

    return $data;
  }
}
