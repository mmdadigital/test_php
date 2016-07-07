<?php
/**
 * Build a menu from an array source.
 * Generate a multi level menu using an multi dimensional array as the source
 *
 * @author Wellington Dutra <wellingtonsdutra@gmail.com>
 */
class MenuBuilder {
  private static $loader;
  private static $loaderPath;
  private static $twig;

  /**
   * Receive an array and build the menu from it.
   *
   * @param  array  $menuSrc A multi dimensional array of menu items
   *
   * @return string The final HTML markup for the menu
   */
  public static function build($menuSrc = array()) {
    if (empty($menuSrc)) {
      throw new Exception("Error: Menu source is empty.", 1);
    }

    self::prepareTwig();

    return self::getMenuMarkup($menuSrc);
  }

  /**
   * Set template path and load Twig Environment.
   *
   * @return void
   */
  private static function prepareTwig() {
    if (!self::$loader) {
      self::$loaderPath = dirname(dirname(__FILE__)).'/app/templates';
      self::$loader     = new \Twig_Loader_Filesystem(self::$loaderPath);
      self::$twig       = new \Twig_Environment(self::$loader, array('autoescape' => false));
    }
  }

  /**
   * Get the menu final markup by iterating over each item.
   *
   * @param  array $menu A multi dimensional array of menu items
   *
   * @return string The final HTML markup for the menu
   */
  private static function getMenuMarkup($menu) {
    $menuItemsMarkup = '';
    $menuMarkup      = '';

    foreach ($menu as $item) {
      $menuItemsMarkup .= self::getItemMarkup($item);
    }

    $menuMarkup = self::$twig->render('menu.tpl.php', array('items' => $menuItemsMarkup));

    return $menuMarkup;
  }

  /**
   * Get an item markup and their possible children.
   *
   * @param  array $item A menu item with the properties href, title and child
   *
   * @return string HTML markup for the item
   */
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
