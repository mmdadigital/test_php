<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;
use Application\Entity;

class Contact {
  protected $db;
  protected $table;

  public function __construct(Connection $db) {
    $this->db    = $db;
    $this->table = 'realty_contacts';
  }

  public function save($contact) {
    $contactData = array(
      'name'       => $contact->getName(),
      'phones'     => $contact->getPhones(),
      'emails'     => $contact->getEmails(),
      'updated_at' => $contact->getUpdatedAt(),
    );

    if ($contact->getId()) {
      $this->db->update($this->table, $contactData, array('id' => $contact->getId()));
    }
    else {
      $contactData['created_at'] = $contact->getCreatedAt();

      $this->db->insert($this->table, $contactData);

      $id = $this->db->lastInsertId();

      $contact->setId($id);
    }

    return $contact->getId();
  }

  public function getCollection() {
    $query    = "SELECT `id`,`name`,`emails`,`phones` FROM $this->table";
    $contacts = $this->db->fetchAll($query);

    return $contacts;
  }

  public function load($ids) {
    $query    = "SELECT `id`,`name`,`emails`,`phones` FROM $this->table WHERE id IN (".implode(',', $ids).")";
    $contacts = $this->db->fetchAll($query);

    return $contacts;
  }
}
