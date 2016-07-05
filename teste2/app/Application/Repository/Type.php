<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;
use Application\Entity;

class Type {
  protected $db;
  protected $table;

  public function __construct(Connection $db) {
    $this->db    = $db;
    $this->table = 'realty_types';
  }

  public function getCollection() {
    $query = "SELECT `id`,`type`,`status` FROM `$this->table`";
    $types = $this->db->fetchAll($query);

    return $types;
  }
}
