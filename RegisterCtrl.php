<?php session_start();
include_once('classes/Member.Class.php');
include_once('classes/Table.Class.php');
include_once('classes/Emailer.Class.php');
include_once('classes/URL.Class.php');
include_once('Data.php');
//var_dump($_SERVER);
if(isset($_SESSION['register_token']) AND isset($_SESSION['register_token_time']) AND isset($_POST['register_token'])) 
{
	if($_SESSION['register_token'] ==$_POST['register_token']) 
	{
		if(time()-$_SESSION['register_token_time']<$session_Life) 
		{
			if($_SERVER['HTTP_REFERER']==dirname($_SERVER['HTTP_REFERER']).'/register.php')
			{
 			$first_name="";$last_name="";$age="";$password="";
			$day="";$month="";$year="";
			$gender="";$pseudonym="";$email="";$telephone="";$country="";
			$address="";$post_code="";$paypal="";$credit_card="";$CSV="";
			$time_zone="";$register_date="";$imprint="";$ident="";$merge="";
				$dj_table=new dj_table($HTMLElement_Table);
				$data_Read=$dj_table->Read_Table_Data("regex,display","");
						$inputs_validity=array();
						if(isset($_POST['first_name']))
						{
						$first_name=trim(htmlentities($_POST['first_name']));	
						 $first_name_Regex="#".$data_Read[0]['regex']."#";
    						if( preg_match($first_name_Regex,$first_name  )==false)
    						{
                            echo '<span class=\'red\'>Invalid first name</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$first_name_validity=true;	
							$inputs_validity[]=true;
							}
						}

						if(isset($_POST['last_name']))
						{
						$last_name=trim(htmlentities($_POST['last_name']));	
						 $last_name_Regex="#".$data_Read[1]['regex']."#";
    						if( preg_match($last_name_Regex, $last_name  )==false)
    						{
                            echo '<span class=\'red\'>Invalid last name</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$last_name_validity=true;
							$inputs_validity[]=true;	
							}
						}

						if(isset($_POST['age']))
						{
						$age=trim(htmlentities($_POST['age']));	
						 $age_Regex="#".$data_Read[2]['regex']."#";
    						if( preg_match($age_Regex, $age  ))
    						{
							$age_validity=true;
							$inputs_validity[]=true;	
							}
							else
							{
							echo '<span class=\'red\'>Invalid age </span>';
							$inputs_validity[]=false;		
							}
						}

						if(isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']))
						{
							$day=htmlentities($_POST['day']);//trim(htmlentities
							$month=htmlentities($_POST['month']);
							$year=htmlentities($_POST['year']);
    						if(!$_POST['day'] || !$_POST['month'] || !$_POST['year'])
							{
                            echo '<span class=\'red\'>Select birth date</span>';
							$inputs_validity[]=false;	
							}
							else
							{
							$birth_validity=true;	
							$inputs_validity[]=true;	
							}
						}
						
						if(isset($_POST['gender']))
						{
							$gender=htmlentities($_POST['gender']);
    						if(!$_POST['gender'] )
							{
                            echo '<span class=\'red\'>Select your gender</span>';	
							$inputs_validity[]=false;
							}
							else
							{
							$gender_validity=true;		
							$inputs_validity[]=true;
							}
						}
						if(isset($_POST['pseudonym']) OR isset($_GET['pseudoCheck']) )
						{
							if(isset( $_POST['pseudonym'] )) 
							{
							$pseudonym=trim(htmlentities($_POST['pseudonym']));	
							}
							elseif( isset($_GET['pseudoCheck']) )
							{
							$pseudonym=htmlentities( ($_GET['pseudoCheck']) );	
							} 
							$pseudonym_Regex="#".$data_Read[5]['regex']."#";
    						if(preg_match($pseudonym_Regex, $pseudonym  )==false)
    						{
                            echo '<span class=\'red\'>Invalid User name</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$dj_table=new dj_table($Registration_Table);
							$data_found=$dj_table->Search_Table_Data("pseudonym='$pseudonym'");
								if(!$data_found)
								{
								$pseudonym_validity=true;	
								$inputs_validity[]=true;	
									if(isset($_GET['pseudoCheck']))
									{
            						echo 'PSEUDO_NOT_DOUBLED';
									}
								}
								else
								{
                            	//echo '<span class=\'red\'>This User name already exists</span>';
								$inputs_validity[]=false;
									if( isset($_GET['pseudoCheck']))
									{
              						echo 'PSEUDO_DOUBLED';
									}
								}
							}
						}

						if(isset($_POST['email']) OR isset($_GET['emailCheck']))
						{
							if(isset($_POST['email']))
							{
							$email=trim(htmlentities($_POST['email']));	
							}
							elseif(isset($_GET['emailCheck']))
							{
							$email=htmlentities($_GET['emailCheck']);		
							}
    						$email_Regex="#".$data_Read[6]['regex']."#";
							if( preg_match($email_Regex, $email  )==false)
    						{
                            echo '<span class=\'red\'>Invalid Email</span>';	
							$inputs_validity[]=false;
							}
							else
							{
							$dj_table=new dj_table($Registration_Table);
							$data_found=$dj_table->Search_Table_Data("email='$email'");
								if(!$data_found)
								{
								$email_validity=true;		
								$inputs_validity[]=true;
									if(isset($_GET['emailCheck']))
									{
									echo 'EMAIL_NOT_DOUBLED';
									}
								}
								else
								{
                            	//echo '<span class=\'red\'>This Email already exists</span>';
								$inputs_validity[]=false;
									if(isset($_GET['emailCheck']))
									{
									echo 'EMAIL_DOUBLED';
									}
								}
							}
						}
						
						if(isset($_POST['telephone']))
						{
						$telephone=trim(htmlentities($_POST['telephone']));	
						 $telephone_Regex="#".$data_Read[7]['regex']."#";
    						if( preg_match($telephone_Regex, $telephone  )==false)
    						{
                            echo '<span class=\'red\'>Invalid phone number</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$telephone_validity=true;
							$inputs_validity[]=true;	
							}
						}
						
						if(isset($_POST['country']))
						{
							$country=htmlentities($_POST['country']);
    						if(!$_POST['country'] )
							{
                            echo '<span class=\'red\'>Select your country</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$country_validity=true;	
							$inputs_validity[]=true;
							}
						}
						if(isset($_POST['address']))
						{
						$address=trim(htmlentities($_POST['address']));	
						 $address_Regex="#".$data_Read[9]['regex']."#";
    						if( preg_match($address_Regex, $address  )==false)
    						{
                            echo '<span class=\'red\'>Invalid address</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$address_validity=true;	
							$inputs_validity[]=true;
							}
						}

						if(isset($_POST['post_code']))
						{
						$post_code=trim(htmlentities($_POST['post_code']));	
						 $post_code_Regex="#".$data_Read[10]['regex']."#";
    						if( preg_match($post_code_Regex, $post_code  )==false)
    						{
                            echo '<span class=\'red\'>Invalid post code</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$post_code_validity=true;
							$inputs_validity[]=true;	
							}
						}

						if(isset($_POST['paypal']))
						{
						$paypal=trim(htmlentities($_POST['paypal']));	
    					$paypal_Regex="#".$data_Read[11]['regex']."#";	
							if( preg_match($paypal_Regex, $paypal  )==false)
    						{
                            echo '<span class=\'red\'>Invalid Paypal email</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$paypal_validity=true;
							$inputs_validity[]=true;	
							}
						}

						if(isset($_POST['credit_card']))
						{
						$credit_card=trim(htmlentities($_POST['credit_card']));	
    					$credit_card_Regex="#".$data_Read[12]['regex']."#";		
							if( preg_match($credit_card_Regex, $credit_card  )==false)
    						{
            				echo '<span class=\'red\'>Invalid credit card number</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$credit_card_validity=true;	
							$inputs_validity[]=true;
							}
						}
						if(isset($_POST['CSV']))
						{
						$CSV=trim(htmlentities($_POST['CSV']));	
						 $CSV_Regex="#".$data_Read[13]['regex']."#";	
    						if( preg_match($CSV_Regex, $CSV  )==false)
    						{
                            echo '<span class=\'red\'>Invalid card security code</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$CSV_validity=true;	
							$inputs_validity[]=true;
							}
						}
						if(isset($_POST['password']))
						{
						$password=trim(htmlentities($_POST['password']));	
						 $password_Regex="#".$data_Read[14]['regex']."#";	
    						if(preg_match($password_Regex, $password  )==false)
    						{
                            echo '<span class=\'red\'>Password must have 6 minimum characters</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$password_validity=true;
							$inputs_validity[]=true;	
							}
						}
						if(isset($password_validity))
						{
							if(isset($_POST['password_confirm']))
							{
							$password_confirm=trim(htmlentities($_POST['password_confirm']));	
    							if($password_confirm!=$password)
    							{
                            	echo '<span class=\'red\'>Password verification is different from password</span>';
								$inputs_validity[]=false;
								}
								else
								{
								$password_confirm_validity=true;
								$inputs_validity[]=true;	
								}
							}
						}
						if(isset($_POST['time_zone']))
						{
							$time_zone=htmlentities($_POST['time_zone']);
    						if(!$_POST['time_zone'] )
							{
                            echo '<span class=\'red\'>Select time zone</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$time_zone_validity=true;
							$inputs_validity[]=true;	
							}
						}
						if(isset($_POST['captcha']))
						{
						$captcha=trim(htmlentities($_POST['captcha']));	
    						if( strlen($captcha)<6)
    						{
                            echo '<span class=\'red\'>Wrong introduced code</span>';
							$_SESSION['captcha_validity']=false;
							$inputs_validity[]=false;
							}
							elseif(strlen($captcha)==6)
							{
								if($_SESSION['captcha_validity']==false)
								{
								echo '<span class=\'red\'>Wrong introduced code</span>';	
								$_SESSION['captcha_validity']=false;
								$inputs_validity[]=false;
								}
								else
								{
								$captcha_validity=true;
								$inputs_validity[]=true;	
								}
							}
						}
						
						if($data_Read[18]['display']=='YES')
						{
							if(isset($_POST['conditions']))
							{
							$conditions_validity=true;		
							$inputs_validity[]=true;	
							}
							else
							{
							echo '<span class=\'red\'>Tick box to accept conditions</span>';
							$inputs_validity[]=false;		
							}
						}
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
		if($all_Inputs_validity==true)
		{
   		$dj_member=new dj_member("","");
   		$HashType=  $dj_member-> getHashType();
   		$merge= $dj_member-> getImprintMerge();
   		$Imprint= $dj_member->  getImprintHash($password, $merge ,$HashType) ;
   		$Ident= $dj_member-> getIdentification($Imprint,$identRegistration);
		$register_date=date("d-m-y H:i:s",time());
		$birth_date=$day."/".$month."/".$year;
		$dj_store=new dj_store();
		$dj_table=new dj_table($Registration_Table);
        $Fileds="`first_name`, `last_name`, `age`,`birth_date`, `gender`, `pseudonym`, `email`, `telephone`, `country`, `address`, ";
		$Fileds.="`post_code`, `paypal`, `credit_card`, `CSV`, `time_zone`, `register_date`, `imprint`,";
		$Fileds.="`ident`, `merge`,`hash_type`,`account`";
		//TEMP
		// for($i=1;$i<107;$i++)
		// {
		//TEMP
		$Data_Array=array($first_name,$last_name,$age,$birth_date,$gender,
		$pseudonym,$email,$telephone,$country,$address,$post_code,$paypal,$credit_card,
		$CSV,$time_zone,$register_date,$Imprint,$Ident,$merge,$HashType,0);
		$register_member=$dj_table->Write_Table_Data($Fileds,$Data_Array);
		//TEMP
		//}
		//TEMP
		if($register_member)
		{
		$dj_table=new dj_table($Option_Table);
		$emailer_data=$dj_table->Read_Table_Data("*","id_option=1");
		$emailer_data=$emailer_data[0]["option_content"];
		eval('$emailer='.$emailer_data);
		$Sender=$emailer['Sender'] ;
  		$From=$emailer['From'];
  		$Reply=$emailer['Reply'] ;
  		$Cc_Email=$emailer['Cc_Email'] ;
 		$Bcc_Email=$emailer['Bcc_Email'];
 		$Activation_Message=html_entity_decode($emailer['Activation_Message']);
		$Ident= $dj_member-> getIdentification($Imprint,$identActivation);
		$dj_member=new dj_member("id_member,email","email='$email'");//
		$id_member=$dj_member->GET_id_member();
		$URL="activation.php?idm={$id_member}&email={$email}&ident={$Ident}";
		$dj_URL= new dj_URL($URL);
		$Secure_URL=$dj_URL->Securiser_URL("sign",$urlMergeRegistration);
		$Secure_URL=dirname($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'/'.$Secure_URL;
		$subject="Account activation & Email verification";
		$email_plain=$Activation_Message;
		$email_plain.="Last name : $last_name ";//
		$email_plain.="First name : $first_name";//
		$email_plain.="Pseudonym : $pseudonym";//
		$email_plain.="Email : $email";//
		$email_plain.="Password : $password";//
		$email_plain.="To activate your account click on this link:";
		$email_plain.=$Secure_URL;
		$email_html='<h1>'.$Activation_Message.'</h1>';
		$email_html.="<b>Last name :</b> $last_name <br>";//
		$email_html.="<b>First name :</b> $first_name<br>";//
		$email_html.="<b>Pseudonym :</b> $pseudonym<br>";//
		$email_html.="<b>Email :</b> $email<br>";//
		$email_html.="<b>Password :</b> $password<br>";//
		$email_html.="To activate your account click or copy paste this link on browser:<br>";
		$email_html.='<a href='.$Secure_URL.'>'.$Secure_URL.'</a>';
		//echo $email_html; //var_dump
		//$dj_emailer	=new dj_emailer($Sender, $From,$Reply,$Cc_Email,$Bcc_Email);
		//$sendState=$dj_emailer->Send_Email($email,$subject, $email_plain,$email_html);
		
		$dj_table=new dj_table($Option_Table);
		$emailer_data=$dj_table->Read_Table_Data("*","id_option=1");
		$emailer_data=$emailer_data[0]["option_content"];
		eval('$emailer='.$emailer_data);
		$Sender=$emailer['Sender'] ;
  		$From=$emailer['From'];
  		$Reply=$emailer['Reply'] ;
  		$Cc_Email=$emailer['Cc_Email'] ;
 		$Bcc_Email=$emailer['Bcc_Email'];
		
		$dj_emailer	=new dj_emailer($Sender, $From,$Reply,$Cc_Email,$Bcc_Email);
		//$email_html=$_SESSION['email_html'];
		//$email_plain='';
		$headers=  Array(
		'from_email'=>$From,
		'from_name'=>$Sender,
		'reply_to_emails'=>explode($Reply,","), 
		/*'reply_to_names'=>array('Ahmed KHABER','HAWCHINE MAHMOUDDI'),*/
		'CC'=>explode($Cc_Email,","), 
		'BCC'=>explode($Bcc_Email,",")); 

		/**$smtp_custom=Array('host'=>'smtp.gmail.com',
		'SMTPAuth'=>true,
		'username'=>'Ahmed.gsm1983@gmail.com',
		'password'=>'09019083AhmedGsm',
		'SMTPSecure'=>'tls',
		'port'=>587); */
		$smtp_custom=false;
		$destinations[]=$email;
		//$sendState=$dj_emailer->Send_Email($email,$email_title, $email_plain,$email_html);
		$sendState=$dj_emailer->Send_Email_EX($headers,$smtp_custom,$destinations,$subject,$email_html,$email_plain/*,$attachments_files*/);
		//var_dump($sendState);
			if($sendState)
			{
			?>
			<div id="success">
				<div><img src="icons/correct.png"/></div>
				<div>Registration done successfully, to activate your account click on link that's sent to your email inbox</div>
			</div>
			<?php
			}
			else
			{
				$error_message="Fail to send email verification link";
			}
		}
		else
		{
			$error_message="Fail to register informations, please verify all informations and try again";
		}
		}
		else
		{
		}
		if(isset($error_message))
		{
		?>
		<div id="fail">
			<div><img src="icons/error.png"/></div>
			<div><?php echo $error_message?></div>
		</div>
		<?php
		}
			}	
		}
		else
		{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=register.php">';
		}
	}
	else
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=register.php">';
	}
}
else
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=register.php">';
}