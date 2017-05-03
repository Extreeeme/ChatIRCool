<?php
use Core\Auth\DBAuth;
define('ROOT', dirname(__DIR__));
require ROOT.'/app/App.php'; // permet l'absolute
App::load();

if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	$page = "home";
}

//////////////bouton connect
$app = App::getInstance();
$auth = new DBAuth($app->getDb());
if ($auth->logged()) {
	$connect = "Disconnect";
}else{
	$connect = "login";
}
/////////////////////////

ob_start();
if ($page==='home') {  // Charge centre page ($content)
	require ROOT.'/pages/index.php';
}elseif ($page==='changelog') {
	require ROOT.'/pages/users/changelog.php';
}elseif ($page==='register') {
	require ROOT.'/pages/users/register.php';
}elseif ($page==='confirm') {
	if (isset($_GET['token'], $_GET['id'])){
		require ROOT.'/pages/users/confirm.php';
	}else{
		require ROOT.'/pages/errors/404.php';
	}
}elseif ($page==='login') {
	require ROOT.'/pages/users/login.php';
}elseif ($page==='Disconnect') {
	require ROOT.'/pages/users/disconnect.php';
}elseif ($page==='403') {
	require ROOT.'/pages/errors/403.php';
}elseif ($page==='404') {
	require ROOT.'/pages/errors/404.php';
}
$content = ob_get_clean(); // Le template
require ROOT.'/pages/templates/default.php';