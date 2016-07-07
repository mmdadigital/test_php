<?php
namespace Application\Extensions;

/**
 * Assets manager
 * Manage Application assets through the navigation
 */
class Assets {
  protected $assets;
  protected $assetsPath;

  /**
   * Constructor
   * @param object $app Main Application instance.
   */
  public function __construct($app) {
    $this->assets     = array();
    $this->assetsPath = APP_URL.'/assets';
    $this->app        = $app;

    // Include default assets.
    $this->addAsset('css', 'app.min.css');
  }

  /**
   * Add an asset to be loaded by Application
   * @param  string $type  Asset type (js, css)
   * @param  string $asset Asset filename
   */
  public function addAsset($type, $asset) {
    array_push($this->assets, array('type' => $type, 'src' => $this->assetsPath.'/'.$type.'/'.$asset));
  }

  /**
   * Get added assets
   * @return array A list of assets
   */
  public function getAssets() {
    return $this->assets;
  }

  /**
   * Render added assets
   * @return string The assets rendered as HTML tags
   */
  public function renderAssets() {
    return $this->app['twig']->render('assets.twig', array('assets' => $this->getAssets()));
  }
}
