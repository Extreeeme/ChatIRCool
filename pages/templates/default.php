<!DOCTYPE html>
<html lang="fr">
  <head>
  	<title><?= App::getInstance()->titre; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap core CSS -->
    <link href="frameworks/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
<body>
    <nav>
    <img src="https://rbdmyanmar.com/wp-content/uploads/2016/06/irc.png" alt="Logo IRC" width="200" height="90">
      <ul>
        <?php if (isset($_SESSION['Auth'])): ?>
          <a href="admin.php?p=home"><li>Accueil</li></a>
          <a href="admin.php?p=changelog"><li>Changelog</li></a>
          <a href="index.php?p=Disconnect"><li>Deconnexion</li></a>
        <?php else : ?>
          <a href="index.php?p=home"><li>Accueil</li></a>
          <a href="index.php?p=changelog"><li>Changelog</li></a>
          <a href="index.php?p=login"><li>Connexion</li></a>
          <a href="index.php?p=register"><li>Inscription</li></a>
        <?php endif ?>
      </ul>
    </nav>

    <div>
      <?=$content;?>
    </div>
</body>
</html>
