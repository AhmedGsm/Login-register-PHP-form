<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        <title>Member register page </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/ico" href="icons/register_form.ico" />   
	</head>
	<body>
	<?php
	include_once("header.php");
	?>
	<div class="main_div">
	<?php
    if(!file_exists('Config.php'))
    {
	$info_message='Web site not ready or in maintenance, please contact administrator for more informations';  
	}
    else
    {
    include_once("Data.php");
    include_once("classes/Store.Class.php");
        $dj_store=new dj_store();
        $Sql_Operation="SHOW TABLES like '$Registration_Table'";
        $Results=$dj_store->Sql_Operation($Sql_Operation) ;
        $Sql_Operation="SHOW TABLES like '$Option_Table'";
        $Results2=$dj_store->Sql_Operation($Sql_Operation) ;
        $Sql_Operation="SHOW TABLES like '$HTMLElement_Table'";
        $Results3=$dj_store->Sql_Operation($Sql_Operation) ;
        $Sql_Operation="SHOW TABLES like '$Admin_Table'";// OR '$'
        $Results4=$dj_store->Sql_Operation($Sql_Operation) ;
        if(!$Results OR !$Results2 OR !$Results3 OR !$Results4)
        {
		$info_message='Web site not ready or in maintenance, please contact administrator for more informations';  
        }
 		
        if($Results4)
        {
	    $Sql_Operation="SELECT * FROM $Admin_Table";
	    $table_Results=$dj_store->Sql_Operation($Sql_Operation) ;
		    if(!$table_Results)
		    {
		    $info_message='Web site not ready or in maintenance, please contact administrator for more informations';  
		    }
            else
            {
			include_once("RegisterForm.php");
            }
	    } 
    }
    if(isset($info_message))
    {
    ?>
    <div id="info">
	    <div><img src="icons/warning.png" ></div>
	    <div><?php echo $info_message?>	</div>
    </div>
    <?php
    }
	
	?>
	</div>
	<?php
	include_once("footer.php");
	?>
 	</body>
</html>
