<?php
namespace Application\Entity;
use Application\Providers;

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
