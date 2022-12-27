<?php
include_once("./_common.php");
include_once(G5_LIB_PATH.'/mailer.lib.php');

function sendMail($sender, $reciver, $wr_subject, $content)
{
	try{
		$mail = new PHPMailer(true);
		$mail->isSMTP();

		$mail->SMTPDebug  = false;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;   // set the SMTP port for the GMAIL server
		$mail->Mailer = "smtp";
		$mail->Username   = "greenpasskorea@gmail.com";  // GMAIL username
		$mail->Password   = "dawcduexjmqsgrea";            // GMAIL password
		$mail->CharSet = 'utf-8';
		$mail->Encoding = "base64";

		$mail->SetFrom($sender, 'moa-admin');
		$mail->AddAddress($reciver, '호스트고객님');

		$mail->isHTML(true);
		$mail->Subject = $wr_subject;
		$mail->Body = $content;
		$mail->Send();
	} catch (phpmailerException $e) {    
		return $e->errorMessage();  
	} catch (Exception $e) {    
		return $e->getMessage();  
	}
	return '';
}
