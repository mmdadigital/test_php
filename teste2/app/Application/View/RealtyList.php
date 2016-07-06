<?php
namespace Application\View;
use Application\Helpers\Helper;
use Application\Repository;
use Application\Providers as Provider;

class RealtyList extends Provider\AbstractClass {
  public function getPage() {
    Helper::$app      = $this->app;
    $realtyRepository = new Repository\Realty($this->app['db']);
    $realties         = Helper::prepareCollection($realtyRepository->getCollection());
    $realties         = Helper::getPictures($realties);

    return $this->app['twig']->render('realty-list.twig', array('realties' => $realties));
  }
}
