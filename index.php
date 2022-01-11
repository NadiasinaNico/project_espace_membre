<?php 
include require 'include/header.html';
?>

<div id="login">
    <h3 class="text-center text-white pt-5">Inscription</h3>
    <div class="container">
      <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-6">
          <div id="login-box" class="col-md-12">

            <center><div class="container" style="background-color:#FB6969;">
              <font color="#8B0505"> <?php if(isset($message)) echo $message;?> </font></div></center> 

              <center><div class="container" style="background-color:#95D588;">
                <font color="#115702" ><?php if(isset($message1)) echo $message1;?></font></div></center>

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

                  <a href="connexion.php" class="btn btn-info btn-md" >Se connecter</a>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>