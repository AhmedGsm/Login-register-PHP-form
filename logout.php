<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        <title>Logout page </title>
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
    $dj_table=new dj_table($Option_Table);
    $all_data=$dj_table->Read_Table_Data("*","");
    $main_page=$all_data[3]["option_content"];
	
	echo "<h1>Loging out redirecting to main page...</h1>";
	if(isset($_SESSION['login_token']) AND isset($_SESSION['login_token_time']) AND isset($_SESSION['login_form_token'])) 
	{
		if($_SESSION['login_token'] == $_SESSION['login_form_token']) 
		{
			if(time()-$_SESSION['login_token_time']<$session_Life) 
			{
				if(isset($_SERVER['HTTP_REFERER']))
				{
					if(isset($_SESSION))
					{
					session_unset();
					session_destroy();
					}
					echo "<meta http-equiv=\"refresh\" content=\"1;url=$main_page\" />";
				}
				else
				{
				echo '<h2>Access error !</h2>';
				$local_path=$_SERVER['REQUEST_URI'];
				$error_message="Direct access not permitted, to access page click this <a href=$local_path >link </a>";
				}
			}
			else
			{
			echo '<h2>Access error !</h2>';	
			echo "<meta http-equiv=\"refresh\" content=\"1;url=$main_page\" />";
			}
		}
		else
		{
		echo '<h2>Access error !</h2>';	
		$error_message='Error accessing this page';
		echo "<meta http-equiv=\"refresh\" content=\"1;url=$main_page\" />";
		}
	}
	else
	{
	echo "<meta http-equiv=\"refresh\" content=\"1;url=$main_page\" />";
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
	</div>
	<?php
	include_once("footer.php");
	?>
 	</body>
	</html>
