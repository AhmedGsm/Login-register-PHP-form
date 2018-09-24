<?php
include_once('classes/Member.Class.php');
include_once('classes/Table.Class.php');
include_once('Data.php');
$token=uniqid(rand(),true);
$_SESSION['token']=$token;
$_SESSION['token_time']=time();
?>
	<div id="div_register">
	<h2>Root administrator registering</h2>
		<ul>
			<li>This page adds a new root administrator to manipulate general settings in admin panel</li>
			<li>Fill all inputs then click on 'Register' button</li>
			<li>'Web site name' data appear in email that you will send</li>
		</ul>
	<p>
	
	</p>
	    <form action='' method='post'>
			<table>
				<tr>
					<td>
						<label for="site_name"><b>Web site name</b></label> 
					</td>
					<td>
						<input type="text" title='Web site name, this appear in email that you send' value='' size="25" maxlength="200" name="site_name" id="site_name" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="site_name_messages">
						</span> 
					</td>
				</tr>
				<tr>
					<td>
						<label for="pseudonym"><b>Identifier</b></label> 
					</td>
					<td>
						<input type="text" title='Identifier' value='' size="25" maxlength="200" name="pseudonym" id="pseudonym" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="pseudonym_messages">
						</span> 
					</td>
				</tr>
				<tr>
					<td>
						<label for="email"><b>Email</b></label>  
					</td>
					<td>
						<input type="email" title='Email' value='' size="25" maxlength="200" name="email" id="email" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="email_messages">
						</span> 
					</td>
				</tr>
				<tr>
					<td>
						<label for="password"><b>Password</b></label> 
					</td>
					<td>
						<input type="password" title='Password' value='' size="25" maxlength="200" name="password" id="password" />
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="password_messages">
						</span>
					</td>
				</tr>
				<tr>
					<td>
						<label for="password_confirm"><b>Password verification</b></label>  
					</td>
					<td>
						<input type="password" title='Password verification' value='' size="25" maxlength="200" name="password_confirm" id="password_confirm" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="password_confirm_messages">
						</span>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type="submit" title='Click button to register data' id="register_button" value='Register' />
					</td>
				</tr>
			</table>
			<input type="hidden"  name="token" value='<?php echo $token?>'/>
		</form>	
	</div>
	<div id='register_results'>
	</div>
	<div id="information_check">
		<div><img src="icons/warning.png" /></div>
		<div>Please check all introduced informations</div>
	</div>
	<script src="Register.js"></script>