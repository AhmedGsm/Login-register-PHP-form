    <?php
include_once('classes/Member.Class.php');
include_once('classes/Table.Class.php');
include_once('classes/Emailer.Class.php');
include_once('classes/URL.Class.php');
include_once('Data.php');
//var_dump($_SESSION);
if(!isset($_SESSION['PAGE_ALREADY_VISITED']))
{
$_SESSION['PAGE_ALREADY_VISITED']='false';
$url=$_SERVER['REQUEST_URI'];
$url=urldecode($url);
echo "<meta http-equiv=\"refresh\" content=\"1;url=$url\"/>";
}
else
{
	unset($_SESSION['PAGE_ALREADY_VISITED']);
	if(isset($_GET['idm']) AND isset($_GET['email']) AND isset($_GET['ident']) AND isset($_GET['sign'])){
	$idm=htmlentities($_GET['idm']);//trim(htmlentities)	 _post
	$email=htmlentities($_GET['email']);
	$ident_URL=htmlentities($_GET['ident']);
	
	$currentURL=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;	
	$dj_URL= new dj_URL($currentURL);
	$securedURL=$dj_URL->Verifier_Securite_URL($urlMergeRegistration);
	if($securedURL=='TRUE')
	{
	$dj_member=new dj_member("*","id_member='$idm'");//
	$imprint=$dj_member->GET_imprint();
	$ident_saved=$dj_member->GET_ident();
	$id_member=$dj_member->GET_id_member();
	$ident_registration=$dj_member-> getIdentification($imprint,$identRegistration);
	$ident_banning=$dj_member-> getIdentification($imprint,$identBan);
	    switch($ident_saved)
		{
		case $ident_registration:
		$ident_update=$dj_member->UPDATE_ident($ident_URL);
		$ident_update_account=$dj_member->UPDATE_account(10);
		//var_dump($ident_update);
		//var_dump($ident_update_account);
			if($ident_update AND $ident_update_account)
			{
			?>
			<div id="success">
				<div><img src="icons/correct.png"/></div>
				<div>Your account activated successfully, now you can access to your account by signing in this <a href='login.php'>page</a></div>
			</div >
			<?php
			}
			else
			{
			$error_message="Fail to activate your account, please contact administrator";
			}
		break;
		case $ident_URL:
			?>
			<div id="info">
				<div><img src="icons/warning.png" ></div>
				<div>Your account already activated, you can access to your account by signing in <a href='login.php'>here<a/></div>
			</div>
			<?php
		break;
		case $ident_banning:
		
			$error_message="You can't reactive your account, because it's banned";
		break;
		default:
		
		$error_message="Unknown error occurred, unable to activate your account";
		}
	}
	else
	{
	$error_message="Request rejected";	
	}
	}
	else
	{
	$error_message="Request rejected";	
	}
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