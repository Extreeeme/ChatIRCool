<?php
use Core\Auth\DBAuth;
$app2 = App::getInstance();
$auth2 = new DBAuth($app2->getDb());

if ($auth2->logged()) {
	header('location: admin.php');
}

?>
<h2>Inscription</h2>

<form method="Post" action="admin.php">
	<input class="form-control" type="text" name="email" placeholder="E-mail">
	<input class="form-control" type="text" name="username" placeholder="Nom d'utilisateur">
	<input class="form-control" type="password" name="password" placeholder="Mot de passe">
	<input class="form-control" type="password" name="passwordRetype" placeholder="Répéter le mot de passe">
	<input class="btn btn-primary" type="submit">
</form>