<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        <title>Count activation & Email verification </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/ico" href="icons/register_form.ico" />   
	</head>
	<body>
	<?php
	include_once("header.php");
	?>
	<div class="main_div">
	<div id='div_container'>
	<h2>Activation state</h2>
	<?php
	include_once("ActivationCtrl.php");
	?>
	</div>
	</div>
	<?php
	include_once("footer.php");
	?>
 	</body>
</html>
