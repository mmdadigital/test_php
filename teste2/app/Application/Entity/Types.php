<?php
namespace Application\Entity;
use Application\Providers;

/**
 * Entity skeleton
 * Object representation of Entity data (get and set data).
 */
class Type extends Providers\AbstractEntity {
  protected $type;
  protected $status;

  public function getType() {
    return $this->type;
  }

  public function getStatus() {
    return $this->status;
  }
}
