<?php 
session_start();
include_once('classes/Admin.Class.php');
include_once('classes/Table.Class.php');
include_once('classes/Emailer.Class.php');
include_once('classes/URL.Class.php');
include_once('Data.php');

if(isset($_SESSION['admin_token']) AND isset($_SESSION['admin_token_time']) AND isset($_POST['admin_token'])) 
{//echo 'r';
	if($_SESSION['admin_token']==$_POST['admin_token']) 
	{
		if(time()-$_SESSION['admin_token_time']<$admin_Session_Life) 
		{
			/*if($_SERVER['HTTP_REFERER']==dirname($_SERVER['HTTP_REFERER']).'/login.php')
			{//echo 'r';*/
						if(isset($_POST['login']))
						{//echo 'r';
						$login=trim(htmlentities($_POST['login']));	
						 $login_Regex="#^([a-zA-Z]{5,20}[0-9]{0,20})$#";
    						if( preg_match($login_Regex, $login))
    						{//echo 'r';
             				$loginOk=true;
             				}
							else
							{
							echo 'Login empty or incorrect<br>'	;	
							}
						}
						if(isset($_POST['password']))
          				{
						$password=trim(htmlentities($_POST['password']));	
							if(!empty($password))
							{
          					$passwordOk=true;
							}
							else
							{
							echo 'Fill password field<br>'	;
							}
          				}
						 
				if(isset($loginOk) AND isset($passwordOk))
				{
				$dj_table= new dj_table($Admin_Table);
				$login_Exists=$dj_table->Search_Table_Data("pseudonym='$login' OR email='$login'");
				if($login_Exists)
				{
				$dj_member= new dj_admin('*',"pseudonym='$login'");
				$id_member= $dj_member->GET_id_member();
				$email= $dj_member->GET_email();
				$merge= $dj_member->GET_merge();
				$HashType=$dj_member->GET_hash_type();
				$registerd_Ident=$dj_member->GET_ident();
				$passwordHash =$dj_member->  getImprintHash($password, $merge ,$HashType) ;
				$dj_table= new dj_table($Admin_Table);
				$password_Exists=$dj_table->Search_Table_Data("imprint='$passwordHash'");
					if($password_Exists)
					{
					$Ident_Registration=$dj_member-> getIdentification($passwordHash,$identRegistration);
					$Ident_Activation= $dj_member-> getIdentification($passwordHash,$identActivation);
					$Ident_Admin= $dj_member-> getIdentification($passwordHash,$identAdmin);
					$ident_banning=$dj_member-> getIdentification($passwordHash ,$identBan);
    					switch($registerd_Ident)
						{
    					case $Ident_Admin:
						if(isset($_POST['login_remember']))
						{
						setcookie("adminidentifier", $login,$cookie_life );
						setcookie("adminpassword", $password, $cookie_life);
						}
						else
						{
						setcookie("adminidentifier", '',time());
						setcookie("adminpassword", '',time());
						}
						$_SESSION['admin_form_token']=$_POST['admin_token'];
						$url="main_admin.php";
						//echo 'redirecting...';
						//echo "<meta http-equiv='Refresh' Content='0;url=main_admin.php'/>";
						//	echo "<meta http-equiv='refresh' content='2;url=$url' />";
							//exit();	
  							//echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
							//header("Location: $URL");
						     //  '<meta http-equiv="refresh" content="1;url=login.php" />';
						echo 'LOGIN_SUCCESS';//TEMP
						//echo '<meta http-equiv="refresh" content="0;url=main_admin.php" />';
						break;
						default:
						$error_message=  'Identifier or/and password incorrect';	
						}
					}
					else
					{
					$error_message= 'Identifier or/and password incorrect';
					}
				}
				else
				{
				$error_message=  'Identifier or/and password incorrect';	
				}
				}
			//}	
		}
		else
		{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
		}
	}
	else
	{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
	}
}
/*TEMPO
echo 'fgfgfgf';
	echo '<meta http-equiv="refresh" content="1;url=login.php"/>';
/*TEMPO*/
		
	
if(isset($error_message))
{
?>
<div id="fail">
	<div><img src="icons/error.png"/></div>
	<div><?php echo $error_message	?></div>
</div >
<?php
}
if(isset($warning_message))
{
?>
	<div id="info">
		<div><img src="icons/warning.png" ></div>
		<div><?php echo $warning_message	?></div>
	</div>
<?php
}
?>