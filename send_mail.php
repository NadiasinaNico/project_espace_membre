<?php
require('PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username='nadiasinanicodev@gmail.com';
$mail->Password='Aslandonance1313';
$mail->SMTPSecure = 'tls';
$mail->Port=587;

$mail->setFrom('nadiasinanicodev@gmail.com', 'Nadiasina');
$mail->addAddress('nadiasinanico46@gmail.com');
$mail->isHTML(true);
$mail->Subject='Cet email est un test';
$mail->Body = 'Afin de valider votre addresse email, merci de cliquer sur le lien suivant';

if(!$mail->send()){
  echo "Mail non envoyé";
  echo '<br>';
  echo 'Erreurs: '.$mail->ErrorInfo;
}else {
  echo "Votre email a bien été envoyé";
}
