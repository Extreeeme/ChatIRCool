<?php
use Core\Auth\DBAuth;
$app2 = App::getInstance();
$auth2 = new DBAuth($app2->getDb());

if ($auth2->logged()) {
	header('location: admin.php');
}

if ($_GET) {
	if (isset($_GET['token'], $_GET['id'])){
		$user_id = $_GET['id'];
		$user_token = $_GET["token"];
		if($auth->confirm($user_id, $user_token)){
			header('location: index.php?p=login');
			exit();
		}else{
			header('location: index.php?p=404');
			exit();
		}
	}
}
?>

