<?php
namespace Application\Providers;

abstract class AbstractEntity {
  protected $id;
  protected $createdAt;
  protected $updatedAt;

  public function setId($id) {
    $this->id = $id;
  }

  public function setCreatedAt() {
    $this->createdAt = date('Y-m-d H:i:s');
  }

  public function setUpdatedAt() {
    $this->updatedAt = date('Y-m-d H:i:s');
  }

  public function getId() {
    return $this->id;
  }

  public function getCreatedAt() {
    return $this->createdAt;
  }

  public function getUpdatedAt() {
    return $this->updatedAt;
  }
}
