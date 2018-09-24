<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Config.php file registering page </title>
	<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main_div">
<div id="div_container">
<h2>Database settings registration</h2>
	<ul>
		<li>This page allow to register Config.php file and script tables on database</li>
		<li>Fill all inputs below then click on 'Register Settings' button</li>
	</ul>
<form id='database_settings' action="" method="post">
	<table>
	  <tr>
		<td>
		  <label for="db_driver"><b>Database driver:</b></label>  
		</td>
		<td>
		  <input type="text" title='Database driver' value='mysql' size="25" maxlength="300" name="db_driver" id="db_driver" />
		</td>
	  </tr>
	  <tr>
		<td>
		</td>
		<td>
		  <span>
		<?php
		if(isset($_POST['settings_register']))
		{
		$db_driver=htmlspecialchars($_POST['db_driver']);
    	if(!empty($db_driver))
		{
			$driver_ok=TRUE;		
		}
		else
		{
		echo 'Fill input above';
		}
		}
		?></span>
		</td>
	  </tr>
	  <tr>
		<td>
		  <label for="db_host"><b>Host:</b></label> 
		</td>
		<td>
		  <input type="text" title='Host' value='localhost' size="25" maxlength="300" name="db_host" id="db_host"/>
		</td>
	  </tr>
	  <tr>
		<td>
		</td>
		<td>
		  <span>
		<?php
		if (isset($_POST['settings_register']))
		{
		$db_host=trim(htmlentities($_POST['db_host']));
    	if(!empty($db_host))
		{
			$host_ok=TRUE;		
		}
		else
		{
		echo 'Fill input above';
		}
		}
		?></span>
		</td>
	  </tr>
	  <tr>
		<td>
		  <label for="db_name"><b>DataBase name:</b></label> 
		</td>
		<td>
		  <input type="text" title='DataBase that will add tables of script' size="25" maxlength="300" name="db_name" id="db_name" value='<?php if(isset($_POST['db_name']))echo $_POST['db_name']?>'/>
		</td>
	  </tr>
	  <tr>
		<td>
		</td>
		<td>
		  <span>
		<?php
		if (isset($_POST['settings_register']))
		{
		$db_name=trim(htmlentities($_POST['db_name']));
    	if(!empty($db_name))
		{
			$name_ok=TRUE;		
		}
		else
		{
		echo 'Fill input above';
		}
		}
		?></span>
		</td>
	  </tr>
	  <tr>
		<td>
		  <label for="dbase_login"><b>DataBase login:</b></label>
		</td>
		<td>
		  <input type="text" title='DataBase login' size="25" maxlength="300" name="dbase_login" id="dbase_login" value='<?php if(isset($_POST['dbase_login']))echo $_POST['dbase_login'] ?>' />
		</td>
	  </tr>
	  <tr>
		<td>
		</td>
		<td>
		  <span>
		<?php
		if (isset($_POST['settings_register']))
		{
		$dbase_login=htmlspecialchars($_POST['dbase_login']);
    	if(!empty($dbase_login))
		{
			$login_ok=TRUE;		
		}
		else
		{
		echo 'Fill input above';
		}
		}
		?></span>
		</td>
	  </tr>
	  <tr>
		<td>
		  <label for="dbase_password"><b>DataBase password:</b></label>  
		</td>
		<td>
		  <input type="password" title='DataBase password' size="25" maxlength="300" name="dbase_password" id="dbase_password" />
		</td>
	  </tr>
	  <tr>
		<td>
		</td>
		<td>
		  <span></span>
		</td>
	  </tr>
	  <tr>
		<td colspan='2'>
		<input type="submit"  title='Register configuration file' name='settings_register' value="Register settings"/> 
		</td>
	  </tr>
	  
	  
	</table>
	<?php
	
	if (isset($_POST['settings_register']))
	{
		$dbase_password=trim(htmlentities($_POST['dbase_password']));
	}
	    if(isset($driver_ok) AND isset($host_ok) AND isset($name_ok) AND isset($login_ok) )
	    {
	        try
			{
	    	$dbh = new PDO("{$db_driver}:host={$db_host};dbname={$db_name}", $dbase_login, $dbase_password);
			if(is_object($dbh))
			{
			$config_content="<?php ";
			$config_content.="$"."dbdriver= '{$db_driver}';" ;
			$config_content.="$"."dbhost= '{$db_host}';" ;
			$config_content.="$"."Base_name= '{$db_name}';" ;
			$config_content.="$"."user='{$dbase_login}';";
			$config_content.="$"."pass= '{$dbase_password}';" ;
			$config_content.=" ?>";
			$config_file=fopen("../Config.php","w+");
			$write_stat=fwrite($config_file,$config_content);
				if($write_stat)
				{
				?>
				<h1>Config.php created successfully, redirecting...</h1>
				<?php
				$create_file=TRUE;
				$uri='installation.php';
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$uri.'">';
				}
				else
				{
				echo '<br><span class=\'fail_message\'>Fail to create "Config.php" file</span><br>';
				}
			fclose($config_file);
			}
	        } catch (PDOException $e) {
    	        echo '<span  class=\'fail_message\'>Connection failed: ' . $e->getMessage().'</span>';
				echo '<br><span  class=\'fail_message\'>Invalid database authentication informations, please verify all inputs</span><br>';
	        }			
	    }
	?>
</form>
</div>
</div>
</body>
</html>