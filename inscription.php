<?php
include require 'include/header.html';
?>

<?php
if (isset($_POST['inscription'])) {
  if (empty($_POST['username']) || !preg_match('/[a-zA-Z0-9]+/', $_POST['username'])) {
    $message =  'Entrer votre username valide';
  } elseif (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $message = 'Entrer votre email valide';
  } elseif (empty($_POST['password']) || $_POST['password'] != $_POST['password2']) {
    $message =  'Votre mot de pass est indentique';
  } else {

    require_once 'include/base_de_donne.php';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $requete = $my_base_de_donne->prepare('INSERT INTO tables_membres(username,email,password) VALUES
     (:username,:email,:password) ');

    $requete->bindValue(':username', $_POST['username']);
    $requete->bindValue(':email', $_POST['email']);
    $requete->bindValue(':password', $_POST['password']);

    $requete->execute();
    $message = "Tout est bien";
  }
}

?>


<div id="login">
  <h3 class="text-center text-white pt-5">Inscription</h3>
  <div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
      <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">

          <center>
            <div class="container" style="background-color:#FB6969;">
              <!-- <font color="#8B0505"> <?php if (isset($message)) echo $message; ?> </font> -->
            </div>
          </center>

          <center>
            <div class="container" style="background-color:#95D588;">
              <!-- <font color="#115702"><?php if (isset($message1)) echo $message1; ?></font> -->
            </div>
          </center>
          <?php if (isset($message)) echo $message; ?>

          <form id="login-form" class="form" action="" method="post">
            <div class="form-group">
              <label for="username" class="text-info">Username:</label><br>
              <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="email" class="text-info">Adresse Email:</label><br>
              <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
              <label for="password" class="text-info">Mot de passe:</label><br>
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="password2" class="text-info">Confirmation du mot de passe:</label><br>
              <input type="password" name="password2" id="password2" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" name="inscription" class="btn btn-info btn-md" value="S'incrire">

              <a href="connexion.php" class="btn btn-info btn-md">Se connecter</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>