<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <title>Script installation</title>
	<link href="../style.css" rel="stylesheet" type="text/css" />
	<link rel="icon" type="image/ico" href="icons/admin_panel.ico" />   
</head>
<body>
<div class='main_div'>
<?php
include_once("Data.php");
include_once("classes/Store.Class.php");
$token=uniqid(rand(),true);
$_SESSION['admin_token']=$token;
$_SESSION['admin_token_time']=time();
if(!file_exists('../Config.php'))
{
?>
<h1>Config file not registered, redirecting to Config file registration page...</h1>
<?php
$uri='Config_Register.php';
echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$uri.'">';	
}
else
{
?>
<h1> Checking tables...</h1>
<?php
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
    <h1>Tables not found...</h1>
    <?php
    $uri='Table_Register.php';
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
		$my_path=$_SERVER['REQUEST_URI'];
		$path_chunks=explode('/',$my_path);
		$page_name=$path_chunks[sizeof($path_chunks)-1];
			if($page_name=='installation.php')
			{
			$info_message='Administrator member already installed, to access admin panel click this <a href=\'login.php\'>link </a>';
			}
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
</body>
</html>
