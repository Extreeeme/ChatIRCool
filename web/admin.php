<?php
use Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));
require ROOT.'/app/App.php';
App::load();

if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	$page = "home";
}

$app = App::getInstance();
$auth = new DBAuth($app->getDb());

//connexion utilisateur via login.php et register.php
if ($_POST) {
	if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['passwordRetype'])){
		if($auth->register($_POST['username'], $_POST['password'], $_POST['passwordRetype'], $_POST['email'])){
			$auth->mymail($_POST['email'],$_POST['username']);
			header('location: index.php?p=login');
			exit();
		}else{
			header('location: index.php?p=register');
			exit();
		}
	}elseif (isset($_POST['username'], $_POST['password'])) {
		if ($auth->login($_POST['username'], $_POST['password'])) {
			//prevoir un message flash
		}else{
			header('location: index.php?p=login');
			exit();
		}
	}elseif(isset($_POST['message'])){
		if($auth->sendMessage($_POST['message'])){

		}
	}
}
//fin connexion utilisateur via login.php

if (!$auth->logged()) {
	$app->forbidden();
}

$connect = "Disconnect";

ob_start();
if ($page==='home') {
	require ROOT.'/pages/admin/index.php';
}elseif ($page==='changelog') {
	require ROOT.'/pages/users/changelog.php';
}else{
	require ROOT.'/pages/errors/404.php';
}
$content = ob_get_clean();
require ROOT.'/pages/templates/default.php'; 