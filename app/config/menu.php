<?php


$menu['test_menu'] = array(
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





?>
