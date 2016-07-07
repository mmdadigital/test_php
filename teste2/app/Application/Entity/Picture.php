<?php
namespace Application\Entity;
use Application\Providers;

/**
 * Entity skeleton
 * Object representation of Entity data (get and set data).
 */
class Picture extends Providers\AbstractEntity {
  protected $picture;
  protected $status;

  public function setPicture($picture) {
    $this->picture = $picture;
  }

  public function setCaption($caption) {
    $this->caption = $caption;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function getPicture() {
    return $this->picture;
  }

  public function getCaption() {
    return $this->caption;
  }

  public function getStatus() {
    return $this->status;
  }
}
