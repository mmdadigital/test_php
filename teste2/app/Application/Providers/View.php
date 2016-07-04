<?php
namespace Application\Providers;
use Silex\Application;
use \ReflectionMethod;

abstract class View {
  protected $app;

  public function __construct($app) {
    if ($app) {
      $this->app = $app;
    }
    else {
      $this->app = new Application();
    }
  }

  public function __call($method, $parameters) {
    $method = str_replace('get', '', lcfirst($method));

    if (method_exists($this, $method)) {
      $reflection = new ReflectionMethod($this, $method);

      if (!$reflection->isPublic()) {
        throw new RuntimeException('Called method is not available.');
      }

      return $this->$method($parameters);
    }
  }
}
