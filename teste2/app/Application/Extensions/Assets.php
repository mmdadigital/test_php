<?php
namespace Application\Extensions;

class Assets {
  protected $assets;
  protected $assetsPath;

  public function __construct($app) {
    $this->assets     = array();
    $this->assetsPath = APP_URL.'/assets';
    $this->app        = $app;

    // Include default assets.
    $this->addAsset('css', 'app.min.css');
  }

  public function addAsset($type, $asset) {
    array_push($this->assets, array('type' => $type, 'src' => $this->assetsPath.'/'.$type.'/'.$asset));
  }

  public function getAssets() {
    return $this->assets;
  }

  public function renderAssets() {
    return $this->app['twig']->render('assets.twig', array('assets' => $this->getAssets()));
  }
}
