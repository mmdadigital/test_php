<?php

$app->get('/', 'Application\Controller\HomeController::index');
$app->mount('/admin', new Application\Controller\Provider\Admin())->before(function ($request, $app) {
  if ('admin/login' !== $request->getPathInfo()) {

  }
});
