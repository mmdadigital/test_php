<?php
namespace Application\Entity;
use Application\Providers;

/**
 * Entity skeleton
 * Object representation of Entity data (get and set data).
 */
class Realty extends Providers\AbstractEntity {
  protected $realtyType;
  protected $address;
  protected $number;
  protected $city;
  protected $region;
  protected $description;
  protected $contacts;

  public function setRealtyType($realtyType) {
    $this->realtyType = $realtyType;
  }

  public function setAddress($address) {
    $this->address = $address;
  }

  public function setNumber($number) {
    $this->number = $number;
  }

  public function setCity($city) {
    $this->city = $city;
  }

  public function setRegion($region) {
    $this->region = $region;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setContacts($contacts) {
    $this->contacts = json_encode($contacts);
  }

  public function getRealtyType() {
    return $this->realtyType;
  }

  public function getAddress() {
    return $this->address;
  }

  public function getNumber() {
    return $this->number;
  }

  public function getCity() {
    return $this->city ;
  }

  public function getRegion() {
    return $this->region;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getContacts() {
    return $this->contacts;
  }
}
