<?php
namespace Application\Extensions;

class TwigForm  {
  public function __construct(&$app) {
    $this->getFunctions($app);
  }

  public function getFunctions(&$app) {
    $applicationUrl = APP_URL;

    $app['twig']->addFunction(new \Twig_SimpleFunction('field_render', function ($fieldname, $element, $parent = false) use ($app) {
      return $app['twig']->render('form-field.twig', array('name' => $fieldname, 'element' => $element, 'parent' => $parent));
    }));

    $app['twig']->addFunction(new \Twig_SimpleFunction('head', function () use ($app) {
      return $app['twig']->render('head.twig');
    }));

    $app['twig']->addFunction(new \Twig_SimpleFunction('bottom', function () use ($app) {
      $assets = $app['assets']->renderAssets();

      return $app['twig']->render('bottom.twig', array('assets' => $assets));
    }));

    $app['twig']->addFunction(new \Twig_SimpleFunction('image_render', function ($path) use ($app, $applicationUrl) {
      $path = $applicationUrl.'/'.$path;

      return $app['twig']->render('form-image.twig', array('path' => $path));
    }));

    $app['twig']->addFunction(new \Twig_SimpleFunction('image_url', function ($path) use ($app, $applicationUrl) {
      return $applicationUrl.'/'.$path;
    }));
  }
}
