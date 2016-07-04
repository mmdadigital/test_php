<?php
namespace Application\Extensions;

class TwigForm  {
  public function __construct(&$app) {
    $this->getFunctions($app);
  }

  public function getFunctions(&$app) {
    $app['twig']->addFunction(new \Twig_SimpleFunction('field_render', function ($fieldname, $element, $parent = false) use ($app) {
      return $app['twig']->render('form-field.twig', array('name' => $fieldname, 'element' => $element, 'parent' => $parent));
    }));
  }
}
