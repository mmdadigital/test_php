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

  public function load($id) {
    $query  = "SELECT * FROM `$this->table` WHERE `id` = $id";
    $realty = $this->db->fetchAssoc($query);

    return $realty;
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
