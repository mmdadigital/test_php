<?php
/**
 * Application routes
 */
$app->mount('/', new Application\Controller\Provider\Front());
$app->mount('/admin', new Application\Controller\Provider\Admin());
