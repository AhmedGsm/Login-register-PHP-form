<?php session_start() ;
include_once('classes/Admin.Class.php');
include_once('classes/Table.Class.php');
include_once('classes/Emailer.Class.php');
include_once('classes/URL.Class.php');
include_once('Data.php');
//echo 'r';
if(isset($_SESSION['recovery_token']) AND isset($_SESSION['recovery_token_time']) AND isset($_POST['recovery_token'])) 
{
	if($_SESSION['recovery_token'] ==$_POST['recovery_token']) 
	{
		if(time()-$_SESSION['recovery_token_time']<$session_Life) 
		{
			if($_SERVER['HTTP_REFERER']==dirname($_SERVER['HTTP_REFERER']).'/recovery.php')
			{
						if(isset($_POST['email']))
						{
						$email=trim(htmlentities($_POST['email']));	
						$email_Regex="#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$#";
    						if(preg_match($email_Regex,$email)==false)
    						{
                            echo '<span class=\'red\'>Must be like: "EmailerMobile@gmail.com"</span>';	
							$inputs_validity[]=false;
							}
							else
							{
								$email_validity=true;		
								$inputs_validity[]=true;
							}
						}
						/*
						*/
						for($i=0;$i<sizeof($inputs_validity);$i++)
						{
							if($inputs_validity[$i]==false)
							{
								$all_Inputs_validity=false;
								break;
							}
							else
							{
							$all_Inputs_validity=true;	
							}
						}
						if($all_Inputs_validity)
						{
							$dj_table=new dj_table($Admin_Table);
							$data_found=$dj_table->Search_Table_Data("email='$email'");
								if(!$data_found)
								{
								$error_message= 'This Email not registered on this site, select your registered Email on this server';
								}
								else
								{
   								$dj_member=new dj_admin("*","email='$email'");
								$idm=$dj_member-> GET_id_member();
   								$HashType=  $dj_member-> GET_hash_type();
   								$merge= $dj_member-> GET_merge();
								
   								$imprint= $dj_member->GET_Imprint();
   								$ident= $dj_member-> getIdentification($imprint,$identRegistration);
								$url="updatepw.php?idm=$idm&email=$email&iden=$ident";
								$dj_URL= new dj_URL($url);
								$Secure_URL=$dj_URL->Securiser_URL("verif",$urlMergeRecovery);
								
								$Secure_URL=dirname($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'/'.$Secure_URL;
								$email_plain="This email contains link to update/recover your password:";
								//$email_plain.="New password:$password";
								$email_plain.="Click a link or copy & paste on browser recover/update password:";
								$email_plain.=$Secure_URL;
								$email_html="<h1>This email contains link to update/recover your password:</h1>";
								//$email_html.="<b>New password:</b>  $password<br>";
								$email_html.="<h4>Click a link or copy & paste on browser recover/update password:</h4>";
						        $email_html.='<a href='.$Secure_URL.'>'.$Secure_URL.'</a>';
								echo $email_html;
								$dj_table=new dj_table($Option_Table);
						        $emailer_data=$dj_table->Read_Table_Data("*","id_option=1");
						        $emailer_data=$emailer_data[0]["option_content"];
						        eval('$emailer='.$emailer_data);
						        $Sender=$emailer['Sender'] ;
  						        $From=$emailer['From'];
  						        $Reply=$emailer['Reply'] ;
  						        $Cc_Email=$emailer['Cc_Email'] ;
 						        $Bcc_Email=$emailer['Bcc_Email'];
								$subject="Password recovery";
 						        // $Activation_Message=html_entity_decode($emailer['Activation_Message']);
						        $dj_emailer	=new dj_emailer($Sender, $From,$Reply,$Cc_Email,$Bcc_Email);
 						        $headers=  Array(
 						        'from_email'=>$From,
 						        'from_name'=>$Sender,
 						        'reply_to_emails'=>explode($Reply,","), 
 						        /*'reply_to_names'=>array('Ahmed KHABER','HAWCHINE MAHMOUDDI'),*/
 						        'CC'=>explode($Cc_Email,","), 
 						        'BCC'=>explode($Bcc_Email,",")); 
 						        /*TEMP*/
 						        $smtp_custom=false;/*Array('host'=>'smtp.gmail.com',
 						        'SMTPAuth'=>true,
 						        'username'=>'Ahmed.gsm1983@gmail.com',
 						        'password'=>'09019083AhmedGsm',
 						        'SMTPSecure'=>'tls',
 						        'port'=>587); */
								
 						        /*TEMP*/
 						        $destinations[]=$email;				   
						        $sendState=$dj_emailer->Send_Email_EX($headers,$smtp_custom,$destinations,$subject,$email_html,$email_plain/*,$attachments_files*/);
								if($sendState)
						        {
						        ?>
						        <div id="success">
							        <div><img src="icons/correct.png"/></div>
							        <div>Password recovery link sent successfully to email, click it to recover/update your password</div>
						        </div >
						        <?php
						        }
						        else
						        {
								$error_message="Fail to send password recovery link by email";
						        }
								}
						}
			}	
		}
		else
		{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=recovery.php">';
		}
	}
	else
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=recovery.php">';
	}
}
else
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=recovery.php">';
}
		if(isset($error_message))
		{
		?>
		<div id="fail">
			<div><img src="icons/error.png"/></div>
			<div><?php echo $error_message	?></div>
		</div >
		<?php
		}
		?>