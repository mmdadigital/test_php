<?php

$app->mount('/', new Application\Controller\Provider\Front());
$app->mount('/admin', new Application\Controller\Provider\Admin())->before(function ($request, $app) {
  if ('admin/login' !== $request->getPathInfo()) {

  }
});
