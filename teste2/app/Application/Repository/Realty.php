<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;

class Realty {
  protected $db;

  public function __construct(Connection $db) {
    $this->db = $db;
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
      $this->db->update('realties', $realtyData, array('id' => $realty->getId()));
    }
    else {
      $realtyData['created_at'] = $realty->getCreatedAt();

      $this->db->insert('realties', $realtyData);

      $id = $this->db->lastInsertId();

      $realty->setId($id);
    }

    return $realty->getId();
  }
}
