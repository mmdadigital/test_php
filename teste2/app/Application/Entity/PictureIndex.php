<?php
namespace Application\Entity;
use Application\Providers;

/**
 * Entity skeleton
 * Object representation of Entity data (get and set data).
 */
class PictureIndex extends Providers\AbstractEntity {
  protected $realty_id;
  protected $picture_id;

  public function setRealtyId($realtyId) {
    $this->realtyId = $realtyId;
  }

  public function setPictureId($pictureId) {
    $this->pictureId = $pictureId;
  }

  public function getRealtyId() {
    return $this->realtyId;
  }

  public function getPictureId() {
    return $this->pictureId;
  }
}
