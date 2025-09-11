<?php
 $to = "biuro@instalprint.pl";
 $name = $_POST['name'];
 $userEmail = $_POST['email'];
 $subject = 'Wiadomość od '. $name;
 $body = $_POST['comments'];
 $headers = 'From:'. $userEmail . "\r\n" .
    'Reply-To:' . $userEmail . "\r\n" .
	"Content-Type: text/plain;charset=utf-8\r\n" .
    'X-Mailer: PHP/' . phpversion();
 if (mail($to, $subject, $body, $headers)) {
   echo("<p>Wiadomość wyslana poprawnie</p>");
  } else {
   echo("<p>Problem z wysłaniem wiadomośći</p>");
  }
 ?>