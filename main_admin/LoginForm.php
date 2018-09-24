	<?php
	$token=uniqid(rand(),true);
	$_SESSION['admin_token']=$token;
	$_SESSION['admin_token_time']=time();
	//var_dump($_COOKIE);
	?>
	<div id='div_login'>
	<h2>Administrator interface log in</h2>
	<ul>
		<li>Fill Identifier & Password fields then click on 'Sign in' button</li>
		<li>If you forget your password, click on 'Forgot my password' link</li>
		<li>If you want to save 'Identifier' & 'Password' on this device, check 'Remember me' checkbox</li>
	</ul>
	<form method='post' action='LoginCtrl.php'>  
	<table>
		<tr>
			<td>
				<label for="login"><b>Identifier</b></label>
			</td>
			<td>
				<input type="text" title='Identifier' value='<?php if(isset($_COOKIE['adminidentifier'])  AND  isset($_COOKIE['adminpassword'])  )echo $_COOKIE['adminidentifier']?>' size="25" maxlength="200" name="login" id="login" />
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
				<input type="password"title='Password' value='<?php if(isset($_COOKIE['adminpassword']) AND isset($_COOKIE['adminpassword']))echo $_COOKIE['adminpassword']?>' size="25" maxlength="200" name="password" id="password" />
				<input type="hidden"  name="admin_token" value='<?php echo $token?>'/>
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
				<a href="recovery.php" title='Recover password or update it' class='recovery_button'>Forgot my password</a>
			</td>
			<td>
				<input type="checkbox" title='Preserve data after closing browser' id="login_remember" name="login_remember" <?php if(isset($_COOKIE['adminidentifier']) AND  isset($_COOKIE['adminpassword']))echo 'checked'?>/>
				<label for="login_remember" /><b>Remember me</b></label>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>	
				<span id=""></span>			
			</td>
		</tr>
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