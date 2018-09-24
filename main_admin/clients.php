<?php session_start();
include_once("Data.php");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        <title>Client operations</title>
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
	if(isset($_SESSION['admin_token']) AND isset($_SESSION['admin_token_time']) AND isset($_SESSION['admin_form_token'])) 
	{
		if($_SESSION['admin_token'] == $_SESSION['admin_form_token'])
		{
			if(time()-$_SESSION['admin_token_time']<$admin_Session_Life) 
			{
				if(isset($_SERVER['HTTP_REFERER']))//prevent URI access #
				{
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
						<h1>General clients operation:</h1>
							<ul>
								<li>Fill email title & email in HTML format</li>
								<li>Send emails to all members</li>
								<li>Send emails to multiple or single member</li>
								<li>Search member with email or pseudo or name</li>
								<li>Search members with Id member, Register date, Email, Pseudo, Account state </li>
								<li>Display members details Email, User Name, First name, Last Name, Account state</li>
								<li>Update account state:Deactivate, activate, Ban</li>
							</ul>
						</div>
						<?php
						?>
						<?php
						include_once("ClientsForm.php");
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
	if(isset($error_message))
	{
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
	</div >
	<?php
	include_once("footerW.php");
	?>
<script src="Clients.js"></script>
<script src="mailer/mailer.js"></script>
 	</body>
</html>  
