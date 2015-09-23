<?php
include_once ('cadastro_controller.php');
include_once ('cadastro_model.php');
include_once ('cadastro_view.php');

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);
if (isset($_GET['action'])) $controller->{$_GET['action']}($_POST);

echo $view->cadastro();
$model->close();
?>
