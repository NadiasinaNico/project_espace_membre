<?php
require 'include/header.html';
require_once 'include/base_de_donne.php';

if($_GET){
  if(isset($_GET['email'])){
    $email = $_GET['email'];
  }
  if(isset($_GET['token'])){
    $token = $_GET['token'];
  }
  if(!empty($email) && !empty($token)){
    $requete = $my_base_de_donne->prepare("SELECT * FROM tables_membres WHERE email=:email AND token=:token WHERE email=:email");
    
    $requete->bindValue(':email', $email);
    $requete->bindValue(':token', $token);

    $requete->execute();

    $nombre->$requete->rowCount();
    
    if($nombre == 1){
      $update = $my_base_de_donne->prepare('UPDATE tables_membres SET validation=:validation, token=:token WHERE email=:email');
      $update->bindValue(':validation', 1);
      $update->bindValue(':token', 'valide');
      $update->bindValue(':email', $email);
      $resultats_update = $update->execute();

      if($resultats_updateresultat){
        $message = "Votre addresse email a été bien confirmer";
      }
    }

  }

}
if(isset($message)) echo $message;

?>