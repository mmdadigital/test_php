<?php
/**
 * Build a menu from a source
 */
class MenuBuilder {
  private static $loader;
  private static $loaderPath;
  private static $twig;

  public static function build($menuSrc = array()) {
    if (empty($menuSrc)) {
      throw new Exception("Error: Menu source is empty.", 1);
    }

    self::prepareTwig();

    return self::getMenuMarkup($menuSrc);
  }

  private static function prepareTwig() {
    if (!self::$loader) {
      self::$loaderPath = dirname(dirname(__FILE__)).'/app/templates';
      self::$loader     = new \Twig_Loader_Filesystem(self::$loaderPath);
      self::$twig       = new \Twig_Environment(self::$loader, array('autoescape' => false));
    }
  }

  private static function getMenuMarkup($menu) {
    $menuItemsMarkup = '';
    $menuMarkup      = '';

    foreach ($menu as $item) {
      $menuItemsMarkup .= self::getItemMarkup($item);
    }

    $menuMarkup = self::$twig->render('menu.tpl.php', array('items' => $menuItemsMarkup));

    return $menuMarkup;
  }

  private static function getItemMarkup($item) {
    $data = array(
      'href'  => isset($item['href'])  ? $item['href']  : '',
      'title' => isset($item['title']) ? $item['title'] : '',
    );

    if (isset($item['child']) && !empty($item['child'])) {
      $data['children'] = self::getMenuMarkup($item['child']);
    }

    $itemMarkup = self::$twig->render('menu.item.tpl.php', $data);

    return $itemMarkup;
  }
}
