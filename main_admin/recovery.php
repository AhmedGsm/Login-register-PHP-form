<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        <title>Password Recovery Utility </title>
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/ico" href="icons/admin_panel.ico" />   
	</head>
	<body>
	<div class="main_div">
	<?php
	include_once("Data.php");
	include_once("classes/Store.Class.php");
    if(!file_exists('../Config.php'))
    {
	echo '<h2>Script not installed, redirecting to installation page...</h2>';
    $uri='installation.php';
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$uri.'">';	  
	}
    else
    {
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
        ?>
        <h2>Tables not found redirecting to installation page...</h2>
        <?php
        $uri='installation.php';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$uri.'">';	
        }
        else
        {
        }  
		
        if($Results4)
        {
	    $Sql_Operation="SELECT * FROM $Admin_Table";
	    $table_Results=$dj_store->Sql_Operation($Sql_Operation) ;
		    if(!$table_Results)
		    {
    	    ?>
   	 	    <h1>All Tables found, redirecting to admin register page...</h1>
   	 	    <?php
		    $uri='register.php';
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$uri.'">';		
		    //echo "<a href='$uri'>   Join admin register Page </a>";
		    }
            else
            {
		    ?>
	        <?php
	        include_once("RecoveryForm.php");
            }
	    } 
    }
	?>
	</div>
 	</body>
	<script src="Recovery.js"></script>
</html>
