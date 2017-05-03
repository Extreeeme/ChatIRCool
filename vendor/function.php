<?php
function debug($erreur){
	echo "<pre>".print_r($erreur, true)."</pre>";
}

function str_random($length){
	$alphabet = "azertyuiopqsdfghjklmwxcvbn1234567890AZERTYUIOPQSDFGHJKLMWXCVBN";
	return substr(str_shuffle(str_repeat($alphabet, $length)),0,$length);
}

function my_mail($user_mail, $pseudo, $message_sujet, $message_html){
	require 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'espacemembre03@gmail.com';                 // SMTP username
	$mail->Password = 'espace03';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	// To load the French version
	$mail->setLanguage('fr', '/optional/path/to/language/directory/');

	$mail->setFrom('espacemembre03@gmail.com', 'Zone membre');
	$mail->addAddress($user_mail, $pseudo);     // Add a recipient

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $message_sujet;
	$mail->Body    = $message_html;
	$mail->AltBody = $message_html;

	if(!$mail->send()) {
	    echo 'Message non-envoyé';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
}