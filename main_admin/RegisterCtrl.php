<?php
session_start();
include_once('classes/Admin.Class.php');
include_once('classes/Table.Class.php');
include_once('classes/Emailer.Class.php');
include_once('classes/URL.Class.php');
include_once('Data.php');
if(isset($_SESSION['token']) AND isset($_SESSION['token_time']) AND isset($_POST['token'])) 
{
	if($_SESSION['token']==$_POST['token']) 
	{
		if(time()-$_SESSION['token_time']<$admin_Session_Life) 
		{
			if($_SERVER['HTTP_REFERER']==dirname($_SERVER['HTTP_REFERER']).'/register.php')
			{
						$inputs_validity=array();
						
						
						if(isset($_POST['site_name']))
						{
						$site_name=trim(htmlentities($_POST['site_name']));	
						$site_name_Regex="#^.{6,}$#";
    						if( preg_match($site_name_Regex, $site_name  )==false)
    						{
                            echo '<span class=\'red\'>Site name must be above 6 alphanumerics charchters with no metacharcters</span>';
							$inputs_validity[]=false;
							}
							else
							{
							$site_name_validity=true;
							$inputs_validity[]=true;	
							}
						}
						if(isset($_POST['pseudonym']) OR isset($_GET['pseudoCheck']) )
						{
							if(isset( $_POST['pseudonym'])) 
							{
							$pseudonym=trim(htmlentities($_POST['pseudonym']));	
							}
							elseif( isset($_GET['pseudoCheck']) )
							{
							$pseudonym=trim(htmlentities( ($_GET['pseudoCheck']) ));	
							} 
						     $pseudonym_Regex="#^[a-zA-Z]{5,20}[0-9]{0,20}$#";
    						if(preg_match($pseudonym_Regex, $pseudonym  )==false)
    						{
                            echo '<span class=\'red\'>Invalid user name</span>';
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
						 	$email_Regex="#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$#";
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
                            	echo '<span class=\'red\'>Email already exists</span>';
								$inputs_validity[]=false;
									if(isset($_GET['emailCheck']))
									{
									echo 'EMAIL_DOUBLED';
									}
								}
							}
						}
						
						if(isset($_POST['password']))
						{
						$password=trim(htmlentities($_POST['password']));	
						$password_Regex="#^.{6,}$#";
    						if( preg_match($password_Regex, $password  )==false)
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
   		$dj_member=new dj_admin("","");
   		$HashType=  $dj_member-> getHashType();
   		$merge= $dj_member-> getImprintMerge();
   		$Imprint= $dj_member->  getImprintHash($password, $merge ,$HashType) ;
   		$Ident= $dj_member-> getIdentification($Imprint,$identAdmin);
		$register_date=date("d-m-y H:i:s",time());
		$role='admin';
		//$dj_store=new dj_store();
		$dj_table=new dj_table($Option_Table);
		$site_name=trim(htmlentities($_POST['site_name']));
		$emailer="array(\"Sender\" =>\"$site_name\",	
		\"From\" =>\"$fromD\",
		\"Reply\" =>\"$replytoD\",
		\"Cc_Email\" =>\"$cc_emailD\",
		\"Bcc_Email\" =>\"$bcc_emailD\",
		\"Activation_Message\" =>\"$activation_messageD\",
		);";
		$update1=$dj_table->Modify_Table_Data("option_content='$emailer'",'id_option=1');
		
		$dj_table=new dj_table($Admin_Table);
        $Fileds="`pseudonym`, `email`, `role`, `register_date`, `imprint`,`ident`, `merge`,`hash_type`,`account`";
		$Data_Array=array($pseudonym,$email,$role,$register_date,$Imprint,$Ident,$merge,$HashType,100);
		$register_member=$dj_table->Write_Table_Data($Fileds,$Data_Array);
			if($register_member)
			{
			?>
			<div id="success">
				<div><img src="icons/correct.png"/></div>
				<div>Registration done successfully, to access Admin Panel click this <a href="login.php">link</a></div>
			</div >
			<?php
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
			</div >
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
