	<?php
	//var_dump($_SERVER);
	include_once('classes/HTMLelement.Class.php');
	include_once('classes/Table.Class.php');
	$dj_table=new dj_table($Option_Table);
	$all_data=$dj_table->Read_Table_Data("*","");
	$email_dta=$all_data[0]["option_content"];
	$hash_type=$all_data[1]["option_content"];
	$login_page=$all_data[2]["option_content"];
	$logout_page=$all_data[3]["option_content"];
	$client_session_time=$all_data[4]["option_content"];
	$admin_session_time=$all_data[5]["option_content"];
	$label_conditions=$all_data[6]["option_content"];
	$login_with=$all_data[7]["option_content"];
	eval('$emailer='.$email_dta);
	$Sender=$emailer['Sender'] ;
	$From=$emailer['From'];
	$Reply=$emailer['Reply'] ;
	$Cc_Email=$emailer['Cc_Email'] ;
	$Bcc_Email=$emailer['Bcc_Email'];
	$Activation_Message=$emailer['Activation_Message'];
	?>
						<div id='div_inner'>
	 					<form action="" method="post" id='my_form'>
	 					<table>
		 					<tr>
			 					<td>
	             					<label for='sender'>Email sender</label>
			 					</td>
			 					<td>
				 					<input type='text' title="Email sender appear in email header" size="25" id="sender" name="sender" value="<?php echo $Sender?>" />
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span id='' ></span>
								</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='from'>Email From</label>
			 					</td>
			 					<td>
				 					<input type='email' title="Email From appear in email header" size="25" id="from" name="from" value="<?php echo $From?>" />
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='replyto'>Email reply to</label>
			 					</td>
			 					<td>
				 					<input type='email' title="Email reply to appear in email header" size="25" id="replyto" name="replyto" value="<?php echo $Reply?>" />
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='cc_email'>Email Cc_Email</label>
			 					</td>
			 					<td>
				 					<input type='email' title="Email Copy carbon, appear in email header" size="25" id="cc_email" name="cc_email" value="<?php echo $Cc_Email?>" />
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='bcc_email'>Email Bcc_Email</label>
			 					</td>
			 					<td>
				 					<input type='email' size="25"  title="Email Blind Carbon Copy" id="bcc_email" name="bcc_email" value="<?php echo $Bcc_Email?>" />
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='activation_message'>Activation message</label>
			 					</td>
			 					<td>
				 					<textarea id="activation_message" title="Activation message apprear in email that sent after registering" width='150' name='activation_message'><?php echo html_entity_decode($Activation_Message)?></textarea>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td id='email_message' >
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='hash_type'>Password Hash Type</label>
			 					</td>
			 					<td>
				 					<select id='hash_type' title="This defines hashing type of password when saved in database" name='hash_type' >
				 					<?php //echo $all_data[1]["option_content"];?>
                     					<option value='1' <?php if($hash_type=="1"){echo 'selected';}?> >sha1(md5($password.$salt))</option >
                     					<option value='2' <?php if($hash_type=="2"){echo 'selected';}?> >sha1(md5($password).$salt)</option >
                     					<option value='3' <?php if($hash_type=="3"){echo 'selected';}?> >sha1($password.$salt) </option >
                     					<option value='4' <?php if($hash_type=="4"){echo 'selected';}?> >md5($password.$salt)</option >
				 					</select>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='login_with'>'Log in' label text</label>
			 					</td>
			 					<td>
				 					<select id='login_with' title='Login Label text on visitor login page' name='login_with' >
				 						<?php // echo $all_data[1]["option_content"];?>
                     					<option value='email_user_name' <?php if($login_with=="email_user_name")echo 'selected'?> >Email or User name</option >
                     					<option value='email' <?php if($login_with=="email")echo 'selected'?> >Email</option >
                     					<option value='user_name' <?php if($login_with=="user_name")echo 'selected'?>>User name</option >
				 					</select>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='login_page'>Client Login page</label>
			 					</td>
			 					<td>
				 					<input type='text' title='Redirected page after success login of visitor' size="25" id="login_page" name="login_page" value="<?php echo $login_page?>" />
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='logout_page'>Client Logout page</label>
			 					</td>
			 					<td>
				 					<input type='text' title='Redirected page after log out of visitor' size="25" id="logout_page" name="logout_page" value="<?php echo $logout_page?>" />
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='client_session' title='Time in minutes'>Client session <br>time</label>
			 					</td>
			 					<td>
				 					<input type='tel' title='Visitor session life time in minutes' size="15" maxlength="3" id="client_session" name="client_session" value="<?php echo $client_session_time?>" /> 
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='admin_session' title='Time in minutes'>Admin session <br> time</label>
			 					</td>
			 					<td>
				 					<input type='tel' title='Administrator session life time in minutes' size="15" maxlength="3" id="admin_session" name="admin_session" value="<?php echo $admin_session_time?>" /> 
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
	             					<label for='label_conditions'>General conditions<br> message label</label>
			 					</td>
			 					<td>
				 					<textarea id="label_conditions" title='General conditions text in visitor register form' width='150' name='label_conditions'><?php echo html_entity_decode($label_conditions)?></textarea>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td>
			 					</td>
			 					<td id='email_message'>
			 					<span ></span>
			 					</td>
		 					</tr>
		 					<tr>
			 					<td colspan='2'>
				 					<input type='submit' title='Update changed data' id='button_update' value='Update data'/>	
			 					</td>
		 					</tr>
		 					<tr>
			 					<td colspan='2'>
			 					</td>
		 					</tr>
	 					</table>
			 					<div id="update_results">
			 					</div>
	 					<div id='unchanged_infos'>
	 					Informations not updated, change them to update
	 					</div>
	 					<div id='informations_error'>
	 					Please check all introduced informations
	 					</div>
	 					</form>
	 					</div>
	 					<script src="Settings.js"></script>