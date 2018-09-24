		<div id='div_container'>
		<h2>Password recovery & update</h2>
		<ul>
			<li>Fill new password, retype new password then click on 'Update password' button</li>
			<li>Go back to <a href='login.php'> login page</a></li>
		</ul>
		<form method='post' action=''>  
	    	<table>
					<tr>
						<td>
							<label for="password"><b>New Password</b></label>  
						</td>
						<td>
							<input type="password" title='Fill new password' value='' size="25" maxlength="200" name="password" id="password" /> 
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
							<label for="password_confirm"><b>Retype new password </b></label>   
						</td>
						<td>
							<input type="password" title='Retype fill new password' value='' size="25" maxlength="200" name="password_confirm" id="password_confirm" />
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
    						<input type="hidden" name="updatepw_token" value="<?php echo $token?>" />	
							<input type="submit" title='Click button to update or recover password' id="login_button" value='Update password' />
						</td>
					</tr>
        	</table>
		</form>
		</div>
