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

    $requete1 = $my_base_de_donne->prepare('SELECT * FROM tables_membres WHERE username = :username');
    $requete1->bindValue(':username', $_POST['username']);
    $requete1->execute();
    $result1 = $requete1->fetch();

    $requete2 = $my_base_de_donne->prepare('SELECT * FROM tables_membres WHERE email = :email');
    $requete2->bindValue(':email', $_POST['email']);
    $requete2->execute();
    $result2 = $requete2->fetch();

    if ($result1) {
      $message = 'Le username existe déja';
    } elseif ($result2) {
      $message = 'L\'email existe déja';
    } else {

      function token_random_string($token_random = 20)
      {
        $token_str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < $token_random; $i++) {
          $token .= $token_str[rand(0, strlen($token_str) - 1)];
        }
      }
      $token = token_random_string(20);

      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $requete = $my_base_de_donne->prepare('INSERT INTO tables_membres(username,email,password,token) VALUES
     (:username,:email,:password,:token) ');

      $requete->bindValue(':username', $_POST['username']);
      $requete->bindValue(':email', $_POST['email']);
      $requete->bindValue(':password', $password);
      $requete->bindValue(':token', $token);

      $requete->execute();


      require('PHPMailer/PHPMailerAutoload.php');

      $mail = new PHPMailer();

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'nadiasinanico46@gmail.com';
      $mail->Password = 'Aslandonance1313';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom('nadiasinanicodev@gmail.com', 'Nadiasina');
      $mail->addAddress($_POST('email'));
      $mail->isHTML(true);
      $mail->Subject = 'Confiramation d\'email';
      $mail->Body = 'Afin de valider votre addresse email, merci de cliquer sur le lien suivant :
      <a href="http://localhost/project_espace_membres/verification.php?email= '.$_POST['email'].'&token='.$token.'">Confirmer</a>';

      if (!$mail->send()) {
        $message =  "Mail non envoyé";
        echo '<br>';
        echo 'Erreurs: ' . $mail->ErrorInfo;
      } else {
        $message =  "Votre email a bien été envoyé";
      }
    }
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