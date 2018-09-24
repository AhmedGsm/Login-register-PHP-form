	<?php
	include_once("classes/Table.Class.php");
	include_once("Data.php");
	$token=uniqid(rand(),true);
	$_SESSION['login_token']=$token;
	$_SESSION['login_token_time']=time();
	
	$d_table=new dj_table($Option_Table);
	$all_data=$d_table->Read_Table_Data("*","");
	$login_with=$all_data[7]["option_content"];
	if($login_with=='email_user_name'){
	$login_type="'Email' or 'User name'";
	}
	elseif($login_with=='email'){
	$login_type='Email';
	}
	elseif($login_with=='user_name'){
	$login_type='User name';
	}
//var_dump($_SERVER);
	?>
	<div id='div_login'>
	<h2>Log in to account</h2>
	<ul>
		<li>Fill Identifier & Password fields then click on 'Sign in' button</li>
		<li>If you forget your password, click on 'Forgot my password' link</li>
		<li>If you want to save 'Identifier' & 'Password' on this device, check 'Remember me' checkbox</li>
	</ul>
	<form method='post' action='' >  
	<table>
		<tr>
			<td>
				<label for="login"><b><?php echo $login_type?></b></label>
			</td>
			<td>
				<input type="text" title='Identifier' value='<?php if(isset($_COOKIE['identifier']) AND isset($_COOKIE['password']))echo $_COOKIE['identifier']?>' size="25" maxlength="200" name="login" id="login" /> 
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<span id="login_messages"></span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="password"><b>Password</b></label>
			</td>
			<td>
				<input type="password" title='Password' value='<?php if(isset($_COOKIE['identifier']) AND isset($_COOKIE['password']))echo $_COOKIE['password']?>' size="25" maxlength="200" name="password" id="password" /> 
				<input type="hidden" name="login_token" value="<?php echo $token?>" />
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<span id="password_messages"></span>
			</td>
		</tr>
		<tr>
			<td>
				<a href="recovery.php" title='Recover password or update it' class='recovery_button' >Forgot my password</a>
			</td>
			<td>
				<input type="checkbox" title='Preserve data after closing browser' id="login_remember" name="login_remember" <?php if(isset($_COOKIE['identifier']) AND isset($_COOKIE['password']))echo 'checked'?>/>  
				<label for="login_remember"><b>Remember me</b></label>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<span id=""></span>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<input type="submit" title='Click to log in' id="login_button" value='Sign in' />
			</td>
		</tr>
	</table>				
	</form>
	</div>
	<div id='register_results'>
	</div>
	<script src="Login.js"></script>