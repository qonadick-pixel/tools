<?
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'phpmailer/Exception.php';
	require 'phpmailer/PHPMailer.php';
	require 'phpmailer/SMTP.php';

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = Config::smtp_debug;	
	$mail->Host = Config::smtp;
	$mail->SMTPAuth = true;
	$mail->Username = Config::smtp_username;
	$mail->Password = Config::smtp_password;
	$mail->SMTPSecure = Config::smtp_secure;
	//$mail->SMTPAutoTLS = false;
	$mail->Port = Config::smtp_port;
	
	/* $mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	); */
	
	$mail->CharSet = 'UTF-8';
	$mail->From = 'support@grndtools.ru';
	$mail->FromName = 'Grand-Tools Support';
?>