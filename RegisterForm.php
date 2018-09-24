<?php
include_once('classes/Member.Class.php');
include_once('classes/Table.Class.php');
include_once('Data.php');

$token=uniqid(rand(),true);
$_SESSION['register_token']=$token;
$_SESSION['register_token_time']=time();

 $first_name="";$last_name="";$age="";$password="";
$day="";$month="";$year="";
$gender="";$pseudonym="";$email="";$telephone="";$country="";
$address="";$post_code="";$paypal="";$credit_card="";$CSV="";
$time_zone="";$register_date="";$imprint="";$ident="";$merge="";
?>
	<div id="div_container">
	    <h2>Registering page</h2>
	    	<ul>
				<li>Fill all inputs then click on 'Register' button</li>
				<li>After register operation, a link sent to your E-mail inbox</li>
				<li>Click on that link to activate your account & confirm  Email address</li>
	    </ul>
	    <form action='' method='post'>
			<table>
			    <?php
				$dj_table=new dj_table($HTMLElement_Table);
				$data_Read=$dj_table->Read_Table_Data("*","");
				if($data_Read[0]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="first_name"><b><?php echo $data_Read[0]['label']?></b></label> 
					</td>
					<td>
						<input type="text" title='First name' value='' size="25" maxlength="200" name="first_name" id="first_name" />
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="first_name_messages">
						</span> 
					</td>
				</tr>
			    <?php
				}
				if($data_Read[1]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="last_name"><b><?php echo $data_Read[1]['label']?></b></label>  
					</td>
					<td>
						<input type="text" title='Last name' value='' size="25" maxlength="200" name="last_name" id="last_name" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="last_name_messages">
						</span>
					</td>
				</tr>
			    <?php
				}
				if($data_Read[2]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="age"><b><?php echo $data_Read[2]['label']?></b></label>  
					</td>
					<td>
						<input type="tel" title='Age' value='' size="25" maxlength="3" name="age" id="age" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="age_messages">
						</span> 
					</td>
				</tr>
			    <?php
				}
				if($data_Read[3]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="day"><b><?php echo $data_Read[3]['label']?></b></label>  
					</td>
					<td> 
						<select name="day" title='Birth date' id="day" class="day"  >
						<option value="" >Day</option>
						<?php
						for($day=1;$day<=31;$day++)
						{
						?>
						<option value="<?php echo $day?>" ><?php echo $day?></option>	
						<?php
						}
						?>
						</select>
					    
						<select name="month" title='Birth date' id="month" class="month"  >
						<option value="" >Month</option>
						<?php
						for($i=0;$i<sizeof($months);$i++)
						{
						?>
						<option value="<?php echo $months[$i]?>" ><?php echo $months[$i]?></option>	
						<?php
						}
						?>
						</select>
					   
						<select name="year" title='Birth date' id="year" class="year"  > 
						<option value="" >Year</option>
						<?php
						$actual_year=date("Y",time());
						//$actual_year=
						for($Year=1900;$Year<=$actual_year;$Year++)
						{
						?>
						<option value="<?php echo $Year?>" ><?php echo $Year?></option>	
						<?php
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="birth_messages">
						</span>
					</td>
				</tr>
			    <?php
				}
				if($data_Read[4]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="gender"><b><?php echo $data_Read[4]['label']?></b></label>   
					</td>
					<td>
						<select name="gender" title='Gender' id="gender" class="gender"  >
							<option value="" >Gender</option>
							<option value="male" >Male</option>
							<option value="female" >Female</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="gender_messages"></span>
					</td>
				</tr>
			    <?php
				}
				if($data_Read[5]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="pseudonym"><b><?php echo $data_Read[5]['label']?></b></label> 
					</td>
					<td>
						<input type="text" title='User name' value='' size="25" maxlength="200" name="pseudonym" id="pseudonym" />
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
			    <?php
				}
				if($data_Read[6]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="email"><b><?php echo $data_Read[6]['label']?></b></label>  
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
			    <?php
				}
				if($data_Read[7]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="telephone"><b><?php echo $data_Read[7]['label']?></b></label> 
					</td>
					<td>
						<input type="tel" title='Telephone' value='' size="25" maxlength="200" name="telephone" id="telephone" />
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="telephone_messages">
						</span>
					</td>
				</tr>
			    <?php
				}
				if($data_Read[8]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="country"><b><?php echo $data_Read[8]['label']?></b></label>  
					</td>
					<td>
						<select name="country"  title='Country' id="country" class="country"  >
						<option value="" >Select your country</option>
			 			<?PHP 
			 			for($i=0;$i<sizeof($coutries_list);$i++)
			 			{
			 			?>
						<option value="<?PHP echo $coutries_list[$i]?>"><?PHP echo $coutries_list[$i]?></option>
			 			<?PHP 
			 			}
			 			?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="country_messages">
						</span> 
					</td>
				</tr>
			    <?php
				}
				if($data_Read[9]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="address"><b><?php echo $data_Read[9]['label']?></b></label>  
					</td>
					<td>
						
						<input type="text" title='Address location' value='' size="25" maxlength="200" name="address" id="address" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="address_messages"></span> 
					</td>
				</tr>
			    <?php
				}
				if($data_Read[10]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="post_code"><b><?php echo $data_Read[10]['label']?></b></label>
					</td>
					<td>
						<input type="text" title='Post code' value='' size="25" maxlength="200" name="post_code" id="post_code" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="post_code_messages">
						</span> 
					</td>
				</tr>
			    <?php
				}
				if($data_Read[11]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="paypal"><b><?php echo $data_Read[11]['label']?></b></label> 
					</td>
					<td>
						<input type="text" title='Paypal address' value='' size="25" maxlength="200" name="paypal" id="paypal" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="paypal_messages">
						</span> 
					</td>
				</tr>
			    <?php
				}
				if($data_Read[12]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="credit_card"><b><?php echo $data_Read[12]['label']?></b></label> 
					</td>
					<td>
						<input type="text" title='Payment credit card' value='' size="25" maxlength="19" name="credit_card" id="credit_card" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="credit_card_messages">
						</span>
					</td>
				</tr>
			    <?php
				}
				if($data_Read[13]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="CSV"><b><?php echo $data_Read[13]['label']?></b></label>  
					</td>
					<td>
						<input type="text" title='Card secutiy number' value='' size="25" maxlength="3" name="CSV" id="CSV" /> 
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="CSV_messages">
						</span> 
					</td>
				</tr>	
			    <?php
				}
				if($data_Read[14]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="password"><b><?php echo $data_Read[14]['label']?></b></label> 
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
			    <?php
				}
				if($data_Read[15]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="password_confirm"><b><?php echo $data_Read[15]['label']?></b></label> 
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
			    <?php
				}
				if($data_Read[16]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="time_zone"><b><?php echo $data_Read[16]['label']?></b></label> 
					</td>
					<td>
						<select name="time_zone" title='Time zone' id="time_zone" class="time_zone"  >
						<option value="" >Time zone</option>
			 			<?PHP 
			 			for($i=0;$i<sizeof($time_zone_list);$i++)
			 			{
			 			?>
						<option value="<?PHP echo $time_zone_list[$i]?>" ><?PHP echo $time_zone_list[$i]?></option>
			 			<?PHP 
			 			}
			 			?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="time_zone_messages">
						</span> 
					</td>
				</tr>
			    <?php
				}
				if($data_Read[17]['display']=='YES')
				{
			    ?>
				<tr>
					<td>
						<label for="captcha"><b><?php echo $data_Read[17]['label']?></b></label> 
					</td>
					<td>
					<?php include_once('captcha/captcha.php') ?>
					</td>
				</tr>
				<!--<tr>
					<td>
					</td>
					<td>
						<span id="messages_captcha"></span> 
					</td>
				</tr>-->
				<script src="captcha/captcha.js"></script>
			    <?php
				}
				if($data_Read[18]['display']=='YES')
				{
					$dj_table=new dj_table($Option_Table);
					$all_data=$dj_table->Read_Table_Data("*","");
					$label_conditions=html_entity_decode($all_data[6]["option_content"]);//
					//$label_conditions=$all_data[6]["option_content"];//
			    ?>
				<tr>
					<td>
						<label for="conditions"><b><?php echo $data_Read[18]['label']?></b></label> 
					</td>
					<td>
						<input type="checkbox" title='General conditions' name="conditions" id="conditions" />
						<label for="conditions"><?php echo $label_conditions?></label>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<span id="messages_conditions"></span>
					</td>
				</tr>
			    <?php
				}
			    ?>
				<tr>
					<td colspan='2'>
						<input type="submit" title='Click button to register data' id="register_button" value='Register' />
					</td>
				</tr>
			</table>
			<input type="hidden"  name="register_token" value='<?php echo $token?>'/>
		</form>	
	</div>
		<div id='register_results'>
		</div>
	  	<div id="information_check">
			<div><img src="icons/warning.png" /></div>
			<div>Please check all introduced informations</div>
		</div>
	<!--<script src="captcha/captcha.js"></script>-->
	<script src="Registration.js"></script>