<?php
	$token=uniqid(rand(),true);
	$_SESSION['recovery_token']=$token;
	$_SESSION['recovery_token_time']=time();
?>
	<div id='div_container'>
	<h2>Password recovery & update</h2>
	<ul>
		<li>Fill Email that you have registered then click on 'Recover password' button</li>
		<li>A link sent to your E-mail inbox </li>
		<li>Click on link supplied, or copy/paste on browser</li>
	</ul>
	<form method='post' action=''>  
	    <table>
				<tr>
					<td>
						<label for="email"><b>Email</b></label>  
					</td>
					<td>
						<input type="email" title='Email that you have registered in this web site' value='' size="25" maxlength="200" name="email" id="email" /> 
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
					<td colspan='2'>
    					<input type="hidden" name="recovery_token" value="<?php echo $token?>" />	
						<input type="submit" title='Click on button to send recovery link to email inbox' id="login_button" value='Recover password' />
					</td>
				</tr>
        </table>
	</form>
	</div>
	<div id='register_results'>
	</div>
	<script src="Recovery.js"></script>