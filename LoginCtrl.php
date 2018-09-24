<?php 
session_start() ;
include_once('classes/Member.Class.php');
include_once('classes/Table.Class.php');
include_once('classes/Emailer.Class.php');
include_once('classes/URL.Class.php');
include_once('Data.php');
//
$login_page='';
$login_state='';
$login_messages='';

if(isset($_SESSION['login_token']) AND isset($_SESSION['login_token_time']) AND isset($_POST['login_token'])) 
{
	if($_SESSION['login_token'] ==$_POST['login_token']) 
	{
		if(time()-$_SESSION['login_token_time']<$session_Life) 
		{
			/*if($_SERVER['HTTP_REFERER']==dirname($_SERVER['HTTP_REFERER']).'/login.php')
			{*/
						if(isset($_POST['login']))
						{
						$login=trim(htmlentities($_POST['login']));	
						//$login=
						 $login_Regex="#^([a-zA-Z]{5,20}[0-9]{0,20})|([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4})$#";
    						if(preg_match($login_Regex, $login))
    						{
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
						
				if(isset($loginOk ) AND isset($passwordOk))
				{
				$dj_table= new dj_table($Registration_Table);
				$login_Exists=$dj_table->Search_Table_Data("pseudonym='$login' OR email='$login'");
				if($login_Exists)
				{
				$dj_member= new dj_member ('*',"pseudonym='$login' OR email='$login'");
				$id_member= $dj_member->GET_id_member();
				$email= $dj_member->GET_email();
				$merge= $dj_member->GET_merge();
				$HashType=$dj_member->GET_hash_type();
				$registerd_Ident=$dj_member->GET_ident();
				$passwordHash =$dj_member->  getImprintHash($password, $merge ,$HashType) ;
				$dj_table= new dj_table($Registration_Table);
				$password_Exists=$dj_table->Search_Table_Data("imprint='$passwordHash'");
					if($password_Exists)
					{
					$calculated_Ident=$dj_member-> getIdentification($passwordHash,$identRegistration);
					$Ident_Activation= $dj_member-> getIdentification($passwordHash,$identActivation);
					$ident_banning=$dj_member-> getIdentification($passwordHash ,$identBan);
    				switch($registerd_Ident)
					{
    				case $Ident_Activation:
					if(isset($_POST['login_remember']))
					{
					setcookie("identifier", $login,$cookie_life);
					setcookie("password", $password, $cookie_life);
					}
					else
					{
					setcookie("identifier", '',time() );
					setcookie("password", '', time());
					}
					$dj_table=new dj_table($Option_Table);
					$all_data=$dj_table->Read_Table_Data("*","");
					$login_page=$all_data[2]["option_content"];
					$dj_member->sessions_Initialization();
					//echo '<meta HTTP-EQUIV="Refresh" Content="0; URL='.$login_page.'">';
					$login_state='LOGIN_SUCCESS';
					$_SESSION['login_form_token']=$_POST['login_token']; 
    				break;   
					case $calculated_Ident:
    				$warning_message= 'Your account not activated, please check your email inbox, then click on link supplied';
    				break;   
    				case $ident_banning :
    				$error_message=  'Access denied, your account is banned, contact administrator';
    				break;   
					default:
					$error_message=  'Unknown account state, please contact administrator';	
					}
					}
					else
					{
					$error_message=  'Identifier or/and password incorrect';
					}
				}
				else
				{
				$error_message=  'Identifier or/and password incorrect';	
				}
				}
	
				if(isset($error_message))
				{
				$login_messages="
				<div id='fail'>
					<div><img src='icons/error.png'/></div>
					<div>$error_message</div>
				</div >";
				}
				if(isset($warning_message))
				{
				$login_messages="
					<div id='info'>
						<div><img src='icons/warning.png' ></div>
						<div>$warning_message</div>
					</div>";
				}
				$login_array=array('login_page'=>$login_page,'login_state'=>$login_state,'login_messages'=>$login_messages);
				echo json_encode($login_array);
			//}	
		}
		else
		{
		echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
		}
	}
	else
	{
		echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
	}
}
else
{
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
}
