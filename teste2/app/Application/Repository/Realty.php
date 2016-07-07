<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;
use Application\Helpers\Helper;

/**
 * Realty Model/Repository
 */
class Realty {
  protected $db;
  protected $table;

  public function __construct(Connection $db) {
    $this->db    = $db;
    $this->table = 'realties';
  }

  /**
   * Save a picture to the index
   */
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

  /**
   * Load a collection of realties
   */
  public function getCollection() {
    $query = "SELECT DISTINCT r.id, r.address, r.number, r.city, r.region, r.description, r.contacts, rt.type
              FROM $this->table as r
              JOIN realty_types as rt ON r.realty_type = rt.id
              JOIN picture_index as pi ON r.id = pi.realty_id";

    $types = $this->db->fetchAll($query);

    return $types;
  }

  /**
   * Load a single realty
   * @param string $id Realty id
   */
  public function load($id) {
    $query  = "SELECT r.id, r.address, r.number, r.city, r.region, r.description, r.contacts, rt.type
               FROM $this->table as r
               JOIN realty_types as rt on rt.id = r.realty_type
               JOIN picture_index as pi ON r.id = pi.realty_id
               WHERE r.id = $id";
    $realty = $this->db->fetchAssoc($query);

    return $realty;
  }

  /**
   * Get a realty by field value, and limit the query
   * @param string $field Field name
   * @param string $value Field value
   * @param int    $limit Query limit
   */
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

  /**
   * Prepare realty object before save
   * @param array $data Realty data
   */
  protected function prepare($data) {
    foreach ($data as $key => $value) {
      if (!$value) {
        unset($data[$key]);
      }
    }

    return $data;
  }
}
