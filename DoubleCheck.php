<?php
include_once('classes/Member.Class.php');
include_once('classes/Table.Class.php');
include_once('classes/Emailer.Class.php');
include_once('classes/URL.Class.php');
include_once('Data.php');
						if(isset($_GET['pseudoCheck']) )
						{
						$pseudonym=htmlentities( ($_GET['pseudoCheck']) );//trim(htmlentities)	
	
							$dj_table=new dj_table($Registration_Table);
							$data_found=$dj_table->Search_Table_Data("pseudonym='$pseudonym'");
								if(!$data_found)
								{
									if( isset($_GET['pseudoCheck']))
									{
            						echo 'PSEUDO_NOT_DOUBLED';
									}
								}
								else
								{
								$inputs_validity[]=false;
									if( isset($_GET['pseudoCheck']))
									{
              						echo 'PSEUDO_DOUBLED';
									}
								}
						}
						if(isset($_GET['emailCheck']) ) 
						{
						$email=htmlentities($_GET['emailCheck']);	
							$dj_table=new dj_table($Registration_Table);
							$data_found=$dj_table->Search_Table_Data("email='$email'");
								if(!$data_found)
								{
								$email_validity=true;		
								$inputs_validity[]=true;
									if(isset($_GET['emailCheck']))
									{
									echo 'EMAIL_NOT_DOUBLED';
									}
								}
								else
								{
								$inputs_validity[]=false;
									if(isset($_GET['emailCheck']))
									{
									echo 'EMAIL_DOUBLED';
									}
								}
						}
?>