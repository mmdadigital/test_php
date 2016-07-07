<?php
namespace Application\Repository;
use Doctrine\DBAL\Connection;
use Application\Entity;

/**
 * Contact Model/Repository
 */
class Contact {
  protected $db;
  protected $table;

  public function __construct(Connection $db) {
    $this->db    = $db;
    $this->table = 'realty_contacts';
  }

  /**
   * Save a contact
   */
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

  /**
   * Get contact collection
   */
  public function getCollection() {
    $query    = "SELECT `id`,`name`,`emails`,`phones` FROM $this->table";
    $contacts = $this->db->fetchAll($query);

    return $contacts;
  }

  /**
   * Load multiple contacts by id
   * @param array $ids An array of ids
   */
  public function loadMultiple($ids) {
    $query    = "SELECT `id`,`name`,`emails`,`phones` FROM $this->table WHERE id IN (".implode(',', $ids).")";
    $contacts = $this->db->fetchAll($query);

    return $contacts;
  }

  /**
   * Load a single contact by id
   * @param int $id Contact id
   */
  public function load($id) {
    $query    = "SELECT `id`,`name`,`emails`,`phones` FROM $this->table WHERE id = $id";
    $contacts = $this->db->fetchAssoc($query);

    return $contacts;
  }
}
