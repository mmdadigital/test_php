<?php
namespace Application\Entity;
use Application\Providers;

class Contact extends Providers\AbstractEntity {
  protected $name;
  protected $phones;
  protected $emails;

  public function setName($name) {
    $this->name = $name;
  }

  public function setPhones($phones) {
    $this->phones = json_encode($phones);
  }

  public function setEmails($emails) {
    $this->emails = json_encode($emails);
  }

  public function getName() {
    return $this->name;
  }

  public function getPhones() {
    return $this->phones;
  }

  public function getEmails() {
    return $this->emails;
  }
}
