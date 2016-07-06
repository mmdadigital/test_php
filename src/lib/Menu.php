<?php

/**
 * @file
 * Menu building related functions.
 */

namespace MDDAMenu;

/**
 * MenuBuilder
 * Handle menu building and update.
 */
class MenuBuilder {
  /**
   * Creates the page menu.
   * @return array the page menu.
   */
  static function init() {
    $menu = new \MDDAMenu\MenuBuilder();
    $menu_settings = $menu->getMenuSettings();
    return array(
      'html' => $menu->getMenuHTML($menu_settings),
      'settings' => $menu_settings
    );
  }

  /**
   * Returns the menu settings.
   * @return array menu settings.
   */
  private function getMenuSettings() {
    $is_custom = FALSE;

    if (!$is_custom) {
      return $this->getDefault();
    }
  }

  /**
   * Returns the default menu structure.
   * @return array the default menu.
   */
  private function getDefault() {
    return array(
      0 => array(
        'title' => 'Home',
        'href' => '/',
      ),
      1 => array(
        'title' => 'Community',
        'href' => '/community',
        'child' => array(
          0 => array(
            'title' => 'Community Home',
            'href' => '/community',
            'child' => array(
              0 => array(
                'title' => 'Irc',
                'href' => '/irc',
              ),
              1 => array(
                'title' => 'Events',
                'href' => '/events',
              ),
            ),
          ),
          1 => array(
            'title' => 'Getting Involved',
            'href' => '/getting-involved',
            'child' => array(
              0 => array(
                'title' => 'Translation',
                'href' => '/translation',
              ),
              1 => array(
                'title' => 'Design',
                'href' => '/contribute/themes',
              ),
              2 => array(
                'title' => 'Coding',
                'href' => '/contribute/development',
              ),
            ),
          ),
        ),
      ),
      2 => array(
        'title' => 'Support',
        'href' => '/support',
        'child' => array(
          0 => array(
            'title' => 'Search',
            'href' => '/search/apachesolr_search',
          ),
          1 => array(
            'title' => 'Forums',
            'href' => '/Forum',
          ),
          2 => array(
            'title' => 'Community Documentation',
            'href' => '/documentation',
          ),
        ),
      ),
    );
  }

  /**
   * Builds the menu HTML from array.
   * @param array the menu definition.
   * @return string the menu HTML.
   */
  private function getMenuHTML($menu) {
    $html = '<ul>';

    foreach ($menu as $menu_item) {
      $html .= '<li><a href="' . $menu_item['href'] . '">' . $menu_item['title'] . '</a></li>';

      if (!empty($menu_item['child'])) {
        $children = $this->getMenuHTML($menu_item['child']);
        $html .= $children;
      }
    }

    return $html . '</ul>';
  }
}
