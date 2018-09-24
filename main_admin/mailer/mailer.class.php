
<?php
//var_dump($_FILES);
//email,$email_titl, $message_PLAIN,$message_HTML
function send_Email($header,$smtp_custom,$destinations,$subject,$html_Body,$plain_Body,$attachments_files)
{
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
if($smtp_custom)
{
$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = $smtp_custom['host'];// 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = $smtp_custom['SMTPAuth'];//true;                     // Enable SMTP authentication
$mail->Username = $smtp_custom['username'];//'Ahmed.gsm1983@gmail.com';          // SMTP username
$mail->Password = $smtp_custom['password'];//'09019083AhmedGsm'; // SMTP password
$mail->SMTPSecure =  $smtp_custom['SMTPSecure'];//'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port =  $smtp_custom['port'];//
} 
// EMAIL HEADER

$mail->setFrom($header['from_email'], $header['from_name']);
//$mail->addReplyTo('info@codexworld.com', 'CodexWorld');   
for($i=0;$i<sizeof($header['reply_to_emails']);$i++)
{
$mail->addReplyTo($header['reply_to_emails'][$i], $header['reply_to_names'][$i]);   
}
foreach($header['CC'] as $CC_email)
{
$mail->addCC($CC_email);
}
foreach($header['BCC'] as $BCC_email)
{
$mail->addBCC($BCC_email);
}
//EMAIL SUBJECT
$mail->Subject =$subject ;//'Email from Localhost by CodexWorld';
//EMAIL DESTINATIONS
foreach($destinations as $email)
{
//	var_dump($email);
$mail->addAddress($email);   
}

$mail->isHTML(true);  // Set email format to HTML

if(preg_match("#<img #i",$html_Body))
{
$html_Body=str_replace('"' ,"'"   , $html_Body);
$email_chunks=preg_split("#<img.+src='#i",$html_Body);
//var_dump($email_chunks) ;
	for ($i=1;$i<sizeof($email_chunks);$i++ )
	{	
	$images_paths[]=explode( "'",$email_chunks[$i])[0];
	}
	//var_dump($images_paths) ;
	$cid=10000;
	foreach($images_paths as $img_paths)
	{
	//var_dump ($img_paths) ;
	$file_name=pathinfo($img_paths,PATHINFO_FILENAME);
	$html_Body=str_replace( $img_paths, 'cid:'.$cid , $html_Body );
	$mail->AddEmbeddedImage($img_paths, "$cid", $file_name); 
	$cid++;
	}
//var_dump($html_Body);
//var_dump ($matches );

}

/*if(is_dir($upload_path))
{
	$files_list=scandir($upload_path);
	$files_list=array_slice($files_list, 2);  
	if(!empty($files_list))
	{*/
if(preg_match("#<embed #i",$html_Body))
{
$html_Body=str_replace('"' ,"'"   , $html_Body);
$email_chunks=preg_split("#<embed.+src='#i",$html_Body);
var_dump($email_chunks) ;
	for ($i=1;$i<sizeof($email_chunks);$i++ )
	{	
	$attachments_files[]=explode("'",$email_chunks[$i])[0];
	}
	var_dump($attachments_files) ;
//	$cid=10000;
	 for($i=0;$i<sizeof($attachments_files );$i++)
		{
			/*$file_name=$files_list[$i];
			$file_path=$upload_path.$file_name;*/
			$file_path=$attachments_files [$i];
			$file_name=pathinfo($file_path,PATHINFO_BASENAME);
			if(is_file ($file_path))
			{
			$mail->AddAttachment($file_path,$file_name);
			}
		}
//	$html_Body=str_replace( $img_paths, 'cid:'.$cid , $html_Body );
//	$mail->AddEmbeddedImage($img_paths, "$cid", $file_name); 
//	$cid++;
}
//var_dump($html_Body);
//var_dump ($matches );


  /*  if($attachments_files)
	{
		for($i=0;$i<sizeof($attachments_files );$i++)
		{
			/*$file_name=$files_list[$i];
			$file_path=$upload_path.$file_name;*//*
			$file_path=$attachments_files [$i];
			$file_name=pathinfo($file_path,PATHINFO_BASENAME);
			if(is_file ($file_path))
			{
			$mail->AddAttachment($file_path,$file_name);
			}
		}
	}*/
    //var_dump ($files_list );
//}	
//Email body with HTML format
$mail->Body    = $html_Body;
//Email body with plain text format
if($plain_Body)
$mail->AltBody    = $plain_Body;


if(!$mail->send()) {
	$sent_stat=false;
   // echo 'hhthhhg h  hfh could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	$sent_stat=true;
   // echo 'Message has been sent';
}

return 	$sent_stat;
}