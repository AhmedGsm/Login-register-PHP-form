<?php session_start();	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        <title>Password recovery & Update </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/ico" href="icons/register_form.ico" />   
	</head>
<body>
<?php
include_once("header.php");
?>
<div class="main_div">
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
	//session_destroy();_post _GET
	if(isset($_GET['idm']) AND isset($_GET['email']) AND isset($_GET['iden']) AND isset($_GET['verif']))
	{
	$currentURL=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;	
	$dj_URL= new dj_URL($currentURL);
	$securedURL=$dj_URL->Verifier_Securite_URL($urlMergeRecovery);
		if($securedURL=='TRUE')
		{
		$token=uniqid(rand(),true);
		//$_SESSION['updatepw_token']=$token;
		//$_SESSION['updatepw_token_time']=time();	
		$_SESSION['upd_idm']=htmlentities($_GET['idm']);
		$_SESSION['upd_email']=htmlentities($_GET['email']);
		//$_SESSION['upd_imprint']=htmlspecialchars($_GET['imprint']);
		var_dump($_SESSION);
		var_dump($_GET);
		?>
		<?php
		include_once("updatepwForm.php");
		?>
		<div id='register_results'>
		</div>
		<?php
		}
		else
		{
		$error_message="Request rejected, error when accessing this page";	
		}
	}
	else
	{
	$error_message="Request rejected, error when accessing this page";	
	}

}
//session_destroy();
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
	</div>
	<?php
	include_once("footer.php");
	?>
 	</body>
	<script src="updatepw.js"></script>
	</html>
