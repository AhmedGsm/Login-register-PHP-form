
					<?php
					$table_Object=new dj_table($Registration_Table);
					$Registered=$table_Object->Read_With_SQL_Function("COUNT(id_member)","");
					//var_dump($Registered);
					//$Registered=126564464164;
					
					$table_Object=new dj_table($Registration_Table);
					$Activated=$table_Object->Read_With_SQL_Function("COUNT(id_member)","account=10");
					//var_dump($Activated);
					
					$table_Object=new dj_table($Registration_Table);
					$Non_Activated=$table_Object->Read_With_SQL_Function("COUNT(id_member)","account=0");
					//var_dump($Non_Activated);
					
					$table_Object=new dj_table($Registration_Table);
					$Banned=$table_Object->Read_With_SQL_Function("COUNT(id_member)","account=-10");
					//var_dump($Banned);
					//unset($TABLE_Objet);
					?>
					<div id='div_clients_ctrl'>
					<h1>Clients details</h1>
					<div id="div_clients_details">
						<h3>Registered </h3><span><?php echo $Registered?></span>
						<h3>Activated </h3><span><?php echo $Activated?></span>
						<h3>Non activated </h3><span><?php echo  $Non_Activated?></span>
						<h3>Banned </h3><span><?php echo  $Banned?></span>
					</div> 
				    <h1>Send Email</h1>
					<div id="div_email">
					<?php
					include_once('mailer/mailerForm.php');
					?>
					</div>
					<form action='' method='post' id="search_form">
					<h1>Search members</h1>
					<div id="div_search">
	            				<div>
									<label for='keyword'>Email or name or pseudo</label><br>
									<input type='text' title='Fill email or user name' size="25" id="keyword" name="keyword" value="<?php if(isset($_SESSION['keyword']))echo $_SESSION['keyword']?>" />
								</div>    
								<div>    
									<label for='orderby'>Order by</label><br>
				    				<select id='orderby' name='orderby'>
                        				<option value='id_member' <?php if(isset($_SESSION['orderby']) AND $_SESSION['orderby']=='id_member')echo 'selected'?> >ID member</option>
                        				<option value='register_date' <?php if(isset($_SESSION['orderby']) AND $_SESSION['orderby']=='register_date')echo 'selected'?> >Register date</option>
                        				<option value='email' <?php if(isset($_SESSION['orderby']) AND $_SESSION['orderby']=='email')echo 'selected'?>>Email</option>
                       					<option value='pseudonym' <?php if(isset($_SESSION['orderby']) AND $_SESSION['orderby']=='pseudonym')echo 'selected'?> >User name</option>
                       					<option value='account' <?php if(isset($_SESSION['orderby']) AND $_SESSION['orderby']=='account')echo 'selected'?> >Account state</option>
				   					</select>   
								</div>    
								<div> 
									<label for='account_state'>Member account state</label><br>
				    				<select id='account_state' name='account_state'>
                        				<option value='all_accounts' <?php if(isset($_SESSION['account_state']) AND $_SESSION['account_state']=='All_accounts')echo 'selected'?> >All accounts</option >
                        				<option value='activated' <?php if(isset($_SESSION['account_state']) AND $_SESSION['account_state']=='activated')echo 'selected'?> >Activated</option >
                        				<option value='inactivated' <?php if(isset($_SESSION['account_state']) AND $_SESSION['account_state']=='inactivated')echo 'selected'?> >Non activated</option >
                        				<option value='banned' <?php if(isset($_SESSION['account_state']) AND $_SESSION['account_state']=='banned')echo 'selected'?> >Banned</option >
				   					</select>   
								</div>    
								<div> 
				    				<label>Listing</label><br> 
                    				<input type='radio' id="ascend" name='ascendesc' value='' <?php if(isset($_SESSION['ascendesc']) AND $_SESSION['ascendesc']=='')echo 'checked' ?> checked><label for="ascend">Ascending</label><br>
                    				<input type='radio' id="descend" name='ascendesc' value='DESC' <?php if(isset($_SESSION['ascendesc']) AND $_SESSION['ascendesc']=='DESC')echo 'checked' ?>><label  for="descend">Descending</label><br>
								</div>
								<input type='submit' title='Click button to list members' class='clients_buttons' id='button_search' value='Search members'/><br>		 
						
						
					</div>
					</form>
					</div> 
					<div id='members_details'>
					</div>
							<!--<div id='members_count'>
							</div>-->
					<div id='empty_email' >
		  				<div id="info">
		  				<div><img src="icons/warning.png" ></div>
		  				<div>Fill email title & plain & html message</div>
		  				</div>
					</div>
					<?php
	//var_dump($_POST);
//var_dump($_SESSION);
?>
