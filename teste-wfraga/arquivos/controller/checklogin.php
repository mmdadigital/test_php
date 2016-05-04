<?php
ob_start();
session_start();
include_once '../config.php';
require '../model/class.db.php';

// Define $myusername and $mypassword
$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);

// Connect to server and select databse.
$login = new loginForm;
$response = $login->checkLogin($myusername, $mypassword);

	if ($response == 'true'){
		$_SESSION['username'] = 'myusername';
		$_SESSION['password'] = 'mypassword';
                 header("location:view/index-forms.php");
	}
	else {

		echo $response;

	}

ob_end_flush();
?>
