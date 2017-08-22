
<?php 
include("../includes/PHPMailerAutoload.php");

$mail = new PHPMailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "send.one.com";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "ssl";   
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "paul@makesmefeel.com";                 
$mail->Password = "Wmmf2m?";                                                   
//Set TCP port to connect to 
$mail->Port = 465;                                   

$mail->From = "paul@makesmefeel.com";
$mail->FromName = "Folding Poetry";

$mail->addAddress("pbotwid@gmail.com", "John Doe");

$mail->isHTML(true);

$mail->Subject = "Your Poem is done!";
$mail->Body = "<i>COngratulations! The poem you contributed to is finished, you can read it here: ödfiahsdlfiahsdlfh</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}

 ?>

<html>
	<head>
		<title>mailer</title>
	</head>
</html>
