<?php

/**
 * @file
 * Define custom callbacks to HTTP requests.
 */
namespace MDDARequestHandler;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \MDDAMenu\MenuBuilder as Menu;
use \MDDAUser\User as User;
use \MDDAPropertyType\PropertyType as PropertyType;
use \MDDAProperty\Property as Property;

require 'vendor/autoload.php';
require 'src/core/Database.php';
require 'src/lib/Menu.php';

/**
 * RequestHandler
 * This class will build the HTML returned as response of a request.
 */
class RequestHandler {
  /**
   * Initialize the page building.
   */
  static function init() {
    $handler = new \MDDARequestHandler\RequestHandler();
    $handler->initSlim();
  }

  /**
   * Initialize Slim framework and routing.
   */
  private function initSlim() {
    $config['displayErrorDetails'] = true;
    $app = new \Slim\App(["settings" => $config]);
    // Add Twig support.
    $container = $app->getContainer();
    // Register component on container.
    $container['view'] = function ($container) {
      $view = new \Slim\Views\Twig('src/templates', [
          'cache' => 'src/templates/cache',
          'auto_reload' => TRUE
      ]);
      $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
      ));

      return $view;
    };
    // Add routers.
    $this->addRouters($app);
    $app->run();
  }

  /**
   * Add routers to HTTP requests.
   * @param \Slim\App $app Slim app.
   */
  private function addRouters($app) {
    // Homepage.
    $app->get('/', function (Request $request, Response $response) {
      $menu = Menu::init();
      return $this->view->render($response, 'home.html', [
        'menu' => $menu['html'],
        'jquery' => 'src/templates/js/jquery.js',
        'app_js' => 'src/templates/js/app.js'
       ]);
    });

    // User registration.
    $app->get('/adicionar-contato', function (Request $request, Response $response) {
      $menu = Menu::init();
      return $this->view->render($response, 'user.html', [
        'jquery' => 'src/templates/js/jquery.js',
        'app_js' => 'src/templates/js/app.js'
       ]);
    });

    // User registration ajax callback.
    $app->get('/salvar-contato/{user_info}', function (Request $request, Response $response, $user_info) {
      require 'src/lib/User.php';
      User::saveUser($user_info);
    });

    // Property registration form.
    $app->get('/adicionar-imovel', function (Request $request, Response $response) {
      require 'src/lib/PropertyType.php';
      require 'src/lib/User.php';

      $types = PropertyType::getTypes();
      $users = User::getUsers();

      return $this->view->render($response, 'property.html', [
        'property_types' => $types,
        'users' => $users,
        'jquery' => 'src/templates/js/jquery.js',
        'app_js' => 'src/templates/js/app.js'
       ]);
    });

    // Property registration ajax callback.
    $app->post('/salvar-imovel', function (Request $request, Response $response, $info) {
      $allPostPutVars = $request->getParsedBody();
      require 'src/lib/Property.php';
      // Return on the first as the property
      // information will be the first item.
      Property::saveProperty($allPostPutVars);
    });

    // Property type registration form.
    $app->get('/adicionar-tipo-imovel', function (Request $request, Response $response) {
      return $this->view->render($response, 'property_type.html', [
        'jquery' => 'src/templates/js/jquery.js',
        'app_js' => 'src/templates/js/app.js'
       ]);
    });

    // Property type registration callback.
    $app->get('/salvar-tipo-imovel/{type_info}', function (Request $request, Response $response, $params) {
      require 'src/lib/PropertyType.php';
      PropertyType::saveType($params);
    });

    // Property listing page.
    $app->get('/imoveis', function (Request $request, Response $response, $params) {
      require 'src/lib/Property.php';
      $property_list = Property::getProperties();
      return $this->view->render($response, 'property_listing.html', [
        'property_list' => $property_list,
        'jquery' => 'src/templates/js/jquery.js',
        'app_js' => 'src/templates/js/app.js'
       ]);
    });

    // Property page.
    $app->get('/imovel/{property_id}', function (Request $request, Response $response, $params) {
      require 'src/lib/Property.php';
      $property = Property::loadProperty($params['property_id']);

      return $this->view->render($response, 'property_page.html', [
        'property' => $property,
        'jquery' => 'src/templates/js/jquery.js',
        'app_js' => 'src/templates/js/app.js'
       ]);
    });
  }
}
