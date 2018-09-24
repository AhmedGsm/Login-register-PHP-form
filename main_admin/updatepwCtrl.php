	<?php
	session_start();
	//var_dump($_SESSION);
	if(isset($_SESSION['upd_idm']))
	{//session_destroy();
    include_once('classes/Admin.Class.php');
    include_once('classes/Table.Class.php');
    include_once('classes/Emailer.Class.php');
    include_once('classes/URL.Class.php');
    include_once('Data.php');
	$idm=$_SESSION['upd_idm'];
	$email=$_SESSION['upd_email'];
	session_destroy();		
	//$new_imprint=$_SESSION['upd_imprint'];
    // echo 'krgrg';
	//var_dump($_POST['password']);
		if(($_POST['password']))
		{
		$password=trim(htmlentities($_POST['password']));	
    		if(strlen($password)<6)
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
	if($all_Inputs_validity)
	{
		
	//$ident=htmlspecialchars($_GET['ident']);
	
   		//$dj_member=new dj_member("","");
		
	$dj_member=new dj_admin("*","id_member='$idm' AND email='$email'");//
	$old_imprint=$dj_member->GET_imprint();
	$old_ident=$dj_member->GET_ident();
	$id_member=$dj_member->GET_id_member();
	$ident_registration=$dj_member-> getIdentification($old_imprint,$identRegistration);
	$ident_Admin=$dj_member-> getIdentification($old_imprint,$identAdmin);
	$ident_banning=$dj_member-> getIdentification($old_imprint,$identBan);
	//****
   	$HashType=  $dj_member-> GET_hash_type();
   	$merge= $dj_member-> GET_merge();
   	$Imprint= $dj_member->  getImprintHash($password, $merge ,$HashType) ;
   	$Ident= $dj_member-> getIdentification($Imprint,$identAdmin);
		switch($old_ident)
		{
		case $ident_registration:
			?>
			<div id="info">
				<div><img src="icons/warning.png" /></div>
				<div>Your account not activated yet, you find activation link and old password on email Inbox</div>
			</div>
			<?php
		break;
		case $ident_Admin:
		$imprint_update=$dj_member->UPDATE_imprint($Imprint);
		//$ident= $dj_member-> getIdentification($new_imprint,$identActivation);
		$ident_update=$dj_member->UPDATE_ident($Ident);
		//var_dump($imprint_update);
		//var_dump($ident_update);
			if($imprint_update AND $ident_update)
			{
			?>
			<div id="success">
				<div><img src="icons/correct.png"/></div>
				<div>Congratulation! Your new password registered successfully, refer to <a href='login.php'>login</a> page</div>
			</div >
			<?php
			}
			else
			{
			$error_message="Fail to register new password, please contact administrator";
			}
		break;
		case $ident_banning:
			$error_message="You can't reactive password, because your count is banned";
		break;
		default:
		$error_message="Unknown error occurred, unable to reactive password";
		}			
	}
	}
	else
	{
	$error_message="Password not updated, please refer to <a href='recovery.php'>recovery page</a> to use a new password";
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
