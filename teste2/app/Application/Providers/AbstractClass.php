<?php
namespace Application\Providers;
use Silex\Application;
use \ReflectionMethod;

/**
 * Abstract class for a view
 */
abstract class AbstractClass {
  protected $app;

  /**
   * Assign the main Application instance to the class
   */
  public function __construct($app) {
    if ($app) {
      $this->app = $app;
    }
    else {
      $this->app = new Application();
    }
  }

  /**
   * Check for magic methods
   */
  public function __call($method, $parameters) {
    $method = preg_replace('/^get/', '', lcfirst($method));

    if (method_exists($this, $method)) {
      $reflection = new ReflectionMethod($this, $method);

      if (!$reflection->isPublic()) {
        throw new RuntimeException('Called method is not available.');
      }

      return $this->$method($parameters);
    }
  }
}
