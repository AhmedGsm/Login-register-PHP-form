<?php

class dj_emailer
{
	private $Sender;
	private $From;
	private $Reply;
	private $Cc_Email;
	private $Bcc_Email;
	
	public function __construct($Sender, $From,$Reply,$Cc_Email,$Bcc_Email)
	{
	 $this->Sender=$Sender;
	 $this->From=$From;
	 $this->Reply=$Reply;
	 $this->Cc_Email=$Cc_Email;
	 $this->Bcc_Email=$Bcc_Email;
	}
	public function Send_Email($email,$email_titl, $message_PLAIN,$message_HTML)
	{
	$boundary = md5(uniqid(time()));
    $headers  = "From: \"{$this->Sender}\"<{$this->From}>\n";
    $headers .= "Reply-To: {$this->Reply}\n";
    $headers .= "Cc: {$this->Cc_Email}\n";
    $headers .= "Bcc: {$this->Bcc_Email}\n";
    $headers .= "X-Priority: 1\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";
	$message = "--".$boundary."\n";
	//$message.="";
    $message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
    $message .= "Content-Transfer-Encoding: quoted-printable\n\n";
    $message.= $message_PLAIN;
    $message.="\n";
    $message .= "--".$boundary."\n";
    $message .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
    $message.= "Content-Transfer-Encoding: quoted-printable\n\n";
    $message.=$message_HTML;
    $message.="\n";
    $message .= "--".$boundary."--\n";
	$etat_envoi=mail($email, $email_titl, $message,$headers);
	return $etat_envoi;
	}

	public function Send_Email_EXX($email,$subject, $message_PLAIN,$message_HTML)
	{
	$boundary = md5(uniqid(time()));
    $header  = "From: \"{$this->Sender}\"<{$this->From}>\r\n";
    $header .= "Reply-To: {$this->Reply}\r\n";
    $header .= "Cc: {$this->Cc_Email}\r\n";
    $header .= "Bcc: {$this->Bcc_Email}\r\n";
    $header .= "X-Priority: 1\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    //$header .= "--".$boundary."\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n\r\n";//
    $header .= "--".$boundary."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";//\r\n
    $header .= $message_PLAIN."\r\n\r\n";//\r\n
    $header .= "--".$boundary."\r\n";
	
    $header .= "Content-type:text/html; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";//\r\n
    $header .= $message_HTML."\r\n\r\n";//\r\n
    $header .= "--".$boundary."--";//\r\n
	
	$message="";
    $etat_envoi=mail($email, $subject, $message, $header) ;
	return $etat_envoi;
	}

	public function send_mail_attachment($filename_path, $mailto, $subject, $message,$filename) 
	{
	$content=file_get_contents($filename_path);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $header = "From: ".$this->Sender." <".$this->From.">\r\n";
    $header .= "Reply-To: ".$this->Reply."\r\n";
    $header .= "Cc: {$this->Cc_Email}\r\n";
    $header .= "Bcc: {$this->Bcc_Email}\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";//
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";//\r\n
    $header .= $message."\r\n\r\n";//\r\n
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; 
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";//\r\n
    $header .= "--".$uid."--";
    $etat_envoi=mail($mailto, $subject, "", $header) ;
	return $etat_envoi;
    }	

    public function Send_Email_EX($header,$smtp_custom,$destinations,$subject,$html_Body,$plain_Body/*,$attachments_files*/)
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
    $mail->addReplyTo($header['reply_to_emails'][$i]/*, $header['reply_to_names'][$i]*/);   
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
    //
	$main_folder="mailer/";
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
		//$img_paths=	$main_folder.$img_paths;
	    //var_dump ($img_paths) ;
	    $file_name=pathinfo($img_paths,PATHINFO_FILENAME);
	    //var_dump ($file_name) ;
	    $html_Body=str_replace( $img_paths, 'cid:'.$cid , $html_Body );
	   // var_dump ($html_Body) ;
	    $mail->AddEmbeddedImage($main_folder.$img_paths, "$cid", $file_name); 
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
    //var_dump($email_chunks) ;
	for ($i=1;$i<sizeof($email_chunks);$i++ )
	{	
	$attachments_files[]=explode("'",$email_chunks[$i])[0];
	}
	//var_dump($attachments_files) ;
    //	$cid=10000;
	 for($i=0;$i<sizeof($attachments_files );$i++)
		{
			/*$file_name=$files_list[$i];
			$file_path=$upload_path.$file_name;*/
			$file_path=$attachments_files [$i];
			var_dump($file_path) ;
			$file_name=pathinfo($file_path,PATHINFO_BASENAME);
			$file_path=	$main_folder.$file_path;
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
    $mail->AltBody= $plain_Body;


    if(!$mail->send()) {
	$sent_stat=false;
   // echo 'hhthhhg h  hfh could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
	$sent_stat=true;
   // echo 'Message has been sent';
    }

    return 	$sent_stat;
    }}