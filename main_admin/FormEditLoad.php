	<div id='div_inner'> 
	<?php
	if(isset($_GET['button_Num']))
	{
	$button_Num=htmlspecialchars($_GET['button_Num']);
	include_once('classes/HTMLelement.Class.php');
	include_once('classes/Member.Class.php');
	include_once('classes/Table.Class.php');
	include_once('Data.php');
		  $dj_table=new dj_table($HTMLElement_Table);
   		  $dataRead=$dj_table-> Read_Table_Data('*','');
			$html_Element= new dj_element("*","id_element=$button_Num");
			$id_element=$html_Element->GET_id_element();
			$element_name=$html_Element->GET_element_name();
			$label=$html_Element->GET_label();	
		  ?>
		  <div class="form_divs" id="form_divs">
		  <form id='form_<?php echo $id_element?>' action='' method='post'>
				<table class='form_edit'>
					<?php 
				//	$element_name=$html_Element->GET_element_name();		
					//var_dump($element_name);					
					$regex=$html_Element->GET_regex();
					$right_message=$html_Element->GET_right_message();
					$wrong_message=$html_Element->GET_wrong_message();
					$doubled_message=$html_Element->GET_double_message();
					$display=$html_Element->GET_display();
					$fields=array('Label name','Message after<br> right format<br>(OPTIONAL)','Message after<br> wrong format');//,'Regex','Error message<br>when already<br>existing'
					$fields_id=array('label','right_message','wrong_message');
					$fields_values=array($label,$right_message,$wrong_message);
					for($k=0;$k<sizeof($fields);$k++)
					{
						$element=$fields_id[$k];
						?>
						
						<!--<input type='hidden' name='element_name' value='<?php //echo $element_name?>' />-->
						<tr>
							<td>
							<label for="<?php echo $element?>">
							<?php echo $fields[$k]?>
							</label>
							</td>
							<td>
						  	<input type='text' size="25" id="<?php echo $element?>" name="<?php echo $element?>" value="<?php echo $fields_values[$k]?>" />
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
					        	<span id="message_<?php echo $element?>">
					        	</span>
							</td>
						</tr>
						<?php 
					}
					if(preg_match("#^pseudonym|email$#",$element_name))
					{
					$element='double_message'	;
						?>
						<tr>
							<td>
								<label for="<?php echo $element?>">
								<?php echo 'Error message when<br> already existing'?>
								</label>
							</td>
							<td>
						  	    <input type='text' size="25" id="<?php echo $element?>" name="<?php echo $element?>" value="<?php echo $doubled_message?>" />
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
					        	<span id="message_<?php echo $element?>">
					        	</span>
							</td>
						</tr>
					<?php 
					}
					
					if(!preg_match("#^birth_date|gender|country|password_verification|time_zone|captcha|conditions$#",$element_name))
					{
					$element='regex'	;
						?>
						<tr>
							<td>
							<label for="<?php echo $element?>">
							<?php echo 'Regex'?>
							</label>
							</td>
							<td>
						  	<input  type='text' size="25" id="<?php echo $element?>" name="<?php echo $element?>" value="<?php echo $regex?>" />
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
					        	<span  id="message_<?php echo $element?>">
					        	</span>
							</td>
						</tr>
					<?php 
					}
					if(preg_match("#^email|Password|password_verification$#",$element_name)){
					$disabled="disabled";
					}
					else{
					$disabled="";
					}
					//$disabled='readonly';
					?>
					<tr>
						<td>
						<label for="displayed">
						Display in form
						</label>
						</td>
						<td>
							<input type='checkbox' id="displayed"  <?php echo $disabled ?> name="displayed" <?php if($display=='YES')echo 'checked';?>   />
							<label for='displayed'>
							<?php
							if($display=='YES')
							{
							echo 'DISPLAYED';
							}
							else
							{
							echo 'HIDDEN';
							}	
							?>
							</label>
							<br>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
					        <span id="message_displayed_<?php echo $id_element?>">
					        </span>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<input type='submit' title='Update changed data' id='button_<?php echo $id_element?>' value='Update data'>	
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
			<!--
			<script>
			var form_subm=document.getElementsByTagName('form')[0];
			form_subm.addEventListener("submit",function(e){e.preventDefault();},false);
			</script>
			-->
			
			

	<?php
	}
	?>
 </div>	