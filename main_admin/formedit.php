<?php session_start();
include_once("Data.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        <title>Form edition </title>
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/ico" href="icons/admin_panel.ico" />   
	</head>
	<body>
	<?php
	include_once("headerW.php");	
	?>	
	<div id="parent_div">
	<?php
	include_once("nav_menu.php");
	?>	
	<div class="admin_main_div" id="admin_main_div" >
	<?php
	//unset($_SESSION);
	if(isset($_SESSION['admin_token']) AND isset($_SESSION['admin_token_time']) AND isset($_SESSION['admin_form_token'])) 
	{
		if($_SESSION['admin_token'] == $_SESSION['admin_form_token'])
		{
			if(time()-$_SESSION['admin_token_time']<$admin_Session_Life) 
			{
				if(isset($_SERVER['HTTP_REFERER']))//prevent URI access #
				{
					//include_once("nav_menu.php");
					$referer_page=$_SERVER['HTTP_REFERER'];
					$local_Dir=dirname($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
					$referer_Dir=dirname($referer_page);
					$url_parts=parse_url($referer_page);
					$referer_page_chunks=explode('/',$url_parts['path']);
					$refere_page_name=$referer_page_chunks[sizeof($referer_page_chunks)-1];
					$allowed_referer_pages=array('main_admin.php','formedit.php','clients.php','settings.php','script_policy.php');
					if($local_Dir==$referer_Dir AND in_array($refere_page_name,$allowed_referer_pages))
					{
					?>
						<div class='div_details'>
						<!--<h1>Form edition:</h1>	-->
						<h1>Register Form Edition:</h1>
						<ul>
							This page allow to Edit form elements Pseudo, first name,...:<br>
							Click on labels to view or update data<br>
							<li>Label name</li>
							<li>Message after right format introduced</li>
							<li>Message wrong right format introduced</li>
							<li>Regex (for both PHP & Javascript)</li>
							<li>Display or hide elements in registration form</li>
						</ul>
						</div>	
						<?php
						include_once("FormEditForm.php");
					}
					else
					{
					$local_path=$_SERVER['REQUEST_URI'];
					$error_message="Access not permitted, return to <a href='login.php' >login page</a> ";
					}
				}
				else
				{
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
				}
				
			}
			else
			{
			$error_message="Session timeout, return to <a href='login.php' >login page</a> to relogin";
			}
		}
		else{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
		}
	}
	else
	{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';	
	}
	?>
	<?php
	if(isset($error_message)){
	?>
	<div class="main_div" id="main_div">
	  <div id="fail">
		<div><img src="icons/error.png"/></div>
		<div><?php echo $error_message	?></div>
	  </div >
	</div >
	<?php
	}
	?>
	</div>
	<div id='float_clear'>
	</div>
	</div>
	<?php
	?>
	<?php
	include_once("footerW.php");
	?>
 	</body>
</html>
