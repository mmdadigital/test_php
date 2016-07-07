<?php
namespace Application\Extensions;

/**
 * Twig extension
 * Manage Twig functions and filters
 */
class TwigForm  {
  /**
   * Constructor
   * @param object $app Main Application instance.
   */
  public function __construct(&$app) {
    $this->getFunctions($app);
  }

  /**
   * Get all defined Twig function
   * @param object $app Main Application instance.
   */
  public function getFunctions(&$app) {
    $applicationUrl = APP_URL;

    /** Render a form field */
    $app['twig']->addFunction(new \Twig_SimpleFunction('field_render', function ($fieldname, $element, $parent = false) use ($app) {
      return $app['twig']->render('form-field.twig', array('name' => $fieldname, 'element' => $element, 'parent' => $parent));
    }));

    /** Main head of Application */
    $app['twig']->addFunction(new \Twig_SimpleFunction('head', function () use ($app) {
      return $app['twig']->render('head.twig');
    }));

    /** Main bottom of Application */
    $app['twig']->addFunction(new \Twig_SimpleFunction('bottom', function () use ($app) {
      $assets = $app['assets']->renderAssets();

      return $app['twig']->render('bottom.twig', array('assets' => $assets));
    }));

    /** Renderize an img tag */
    $app['twig']->addFunction(new \Twig_SimpleFunction('image_render', function ($path) use ($app, $applicationUrl) {
      $path = $applicationUrl.'/'.$path;

      return $app['twig']->render('form-image.twig', array('path' => $path));
    }));

    /** Get an img url */
    $app['twig']->addFunction(new \Twig_SimpleFunction('image_url', function ($path) use ($app, $applicationUrl) {
      return $applicationUrl.'/'.$path;
    }));
  }
}
