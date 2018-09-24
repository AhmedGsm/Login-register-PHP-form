<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Script tables registering page </title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main_div">

<?php
include_once("classes/Store.Class.php");
include_once("Data.php");
$dj_store=new dj_store();
?>
<h1>Registering tables, please wait...</h1>
<?php
$Writing_Results=$dj_store->Sql_Operation_WR($memberTable.';'.$adminTable);
$Writing_Results2=$dj_store->Sql_Operation_WR($optionsTable.';'.$elementsTable);
$Writing_Results3=$dj_store->Sql_Operation_WR($insertOptionsTable);
$Writing_Results4=$dj_store->Sql_Operation_WR($insertElementsTable);
if($Writing_Results AND $Writing_Results2 AND $Writing_Results3 AND $Writing_Results4)
{
?>
<h1>Tables registered successfully, redirecting...</h1>
<?php
$uri='installation.php';
echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$uri.'">';	
}
else
{

$info_message= "Fail to register tables, please delete all tables <b>'$Registration_Table, $Option_Table, $Admin_Table'</b> and <b>'Config.php'</b> file then reinstall script";
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
</div >
</body>
</html>