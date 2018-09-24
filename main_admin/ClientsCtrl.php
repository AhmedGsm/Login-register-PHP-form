<?php
session_start();
//var_dump($_SESSION);
//var_dump($_GET);
include_once('classes/Table.Class.php');
include_once('classes/Member.Class.php'); 
include_once('classes/Emailer.Class.php');
include_once('classes/Limiter.Class.php');
include_once('Data.php');
//
//var_dump($_POST);
$min_On_Page=10;
$max_On_Page=50;

$operation=htmlentities($_GET['operation']);//trim(htmlentities

if(isset($_GET['elems']))
{
$elems=htmlentities($_GET['elems']);
}
if(isset($_GET['page']))
{
$page=htmlentities($_GET['page']);
}

if($operation=='load_members' OR(isset($elems) AND isset($page)) )
{
    if(isset($_POST['keyword']))
	{
	$keyword=trim(htmlentities($_POST['keyword']));
	$_SESSION['keyword']=$keyword;	
	}
	else
	{
	$keyword=$_SESSION['keyword'];
	}
    if(isset($_POST['orderby']))
	{
	$orderby=htmlentities($_POST['orderby']);
	$_SESSION['orderby']=$orderby;	
	}
	else
	{
	$orderby=$_SESSION['orderby'];
	}
    if(isset($_POST['ascendesc']))
	{
	$ascendesc=htmlentities($_POST['ascendesc']);
	$_SESSION['ascendesc']=$ascendesc;	
	}
	else
	{
		if(isset($_SESSION['ascendesc']))
		{
		$ascendesc=$_SESSION['ascendesc'];
		}else
		{
		$_SESSION['ascendesc']='';
		}
	}
	
	//ACCOUNT TYPE
    if(isset($_POST['account_state']))
	{
	$account_state=htmlentities($_POST['account_state']);
	$_SESSION['account_state']=$account_state;	
	}
	else
	{
	$account_state=$_SESSION['account_state'];
	}
	
	$sign='=';
	switch($account_state){
	
	case 'all_accounts':
	$account_state='10';
	$sign='<=';
	break;
	
	case 'activated':
	$account_state='10';
	break;
	
	case 'inactivated':
	$account_state='0';
	break;
	
	case 'banned':
	$account_state='-10';
	break;
	
	default:
	}
	//$orderby=htmlspecialchars($_POST['orderby']);
	
	//$ascendesc=htmlspecialchars($_POST['ascendesc']);
$table=new dj_table($Registration_Table);
//$_SESSION['keyword']=$keyword;
/*var_dump($_POST);
var_dump($keyword);
var_dump($orderby);
var_dump($ascendesc);*/
if(!empty($keyword))
{
//$precisions="first_name LIKE '%$keyword%' OR last_name LIKE '%$keyword%' OR pseudonym LIKE '%$keyword%' OR email LIKE '%$keyword%' ORDER BY $orderby $ascendesc";
$precisions="(first_name LIKE '%$keyword%' OR last_name LIKE '%$keyword%' OR pseudonym LIKE '%$keyword%' OR email LIKE '%$keyword%') AND account$sign$account_state ORDER BY $orderby $ascendesc";
}
else
{
//$precisions="id_member>0 ORDER BY $orderby $ascendesc";
$precisions="id_member>0 AND account$sign$account_state ORDER BY $orderby $ascendesc";
}
//var_dump($precisions);

$members=$table->Read_Table_Data("*",$precisions);
// $members=false;
//var_dump($members);
if(!empty($members))
{
    $count_members=sizeof($members);
     // $count_members=3000;
    //$count_members=0;
	if($count_members>$min_onPage)
	{
	?>
	<div id="div_limiter">
	<?PHP
	$limiter= new dj_limiter();
	$limit=$limiter->display_Limiter($count_members,'#members_details');
	$loop_Start=$limit['loop_start'];
	$loop_End=$limit['loop_end'];
	//var_dump($loop_Start);
	//var_dump($);
	//var_dump($loop_End);
	//var_dump($);
	?>
	</div>
	<?PHP
	}
	else{
	$loop_Start=1;	
	$loop_End=$count_members;
	}
	?>
<table class='members_operations'>
	<tr>
		<th>
		Member details
		</th>
		<th>
		Account operations & send Email
		</th>
	</tr>
	<?php
	//if(!isset($loop_Start AND $loop_End)){
	//}
		
	for($i=$loop_Start-1;$i<$loop_End;$i++)
	{
	?>
	<tr>
	  <!--div id='label_details'>Member details</div>email_title-->
		<td>
		<?php echo '<b>ID:</b> '.$members[$i]['id_member']?><br>
		<?php 
		if(!empty($members[$i]['pseudonym']))
		{
		echo '<b>User name:</b> '.$members[$i]['pseudonym'].'<br>';
		}
		else
		{
		echo "<b>User name:</b> Not used<br>";	
		}
		?>
		<?php 
		if(!empty($members[$i]['first_name']))
		{
		echo '<b>First name:</b> '.$members[$i]['first_name'].'<br>';
		}
		else
		{
		echo "<b>First name:</b> Not used<br>";	
		}
		?>
		<?php 
		if(!empty($members[$i]['last_name']))
		{
		echo '<b>Last name:</b> '.$members[$i]['last_name'].'<br>';
		}
		else
		{
		echo "<b>Last name:</b> Not used<br>";	
		}
		?>
		<?php echo '<b>Email:</b> '.$members[$i]['email']?><br>
		<?php echo '<b>Register date:</b> '.$members[$i]['register_date']?><br>
		<?php
		$member=new dj_member("","");//
		$imprint=$members[$i]['imprint'];
		$ident_registration=$member-> getIdentification($imprint,$identRegistration);
		$ident_Activation=$member-> getIdentification($imprint,$identActivation);
		$ident_banning=$member-> getIdentification($imprint,$identBan);
		echo "<b>Account state: </b>";	
		switch( $members[$i]['ident'])
		{
		case $ident_registration:
		echo "Not activated";
		break;	

		case $ident_Activation:
		echo "Activated";
		break;	

		case $ident_banning:
		echo "Banned";
		break;	

        default:		
		echo "Unknown state";	
		}
		$id_member=$members[$i]['id_member'];
		?>
		</td>
		<td>
			<form action="" method="post" id='form_<?php echo $id_member?>'> 
			<h4>Account operation</h4>
			<select id='operations_<?php echo $id_member?>'  title="Click to select operation from the list then click on 'Update account'" name='operations'>
                <option value='' >Select operation</option>
                <option value='deactivate' >Deactivate</option>
                <option value='activate' >Activate</option>
                <option value='ban' >Ban</option>
			</select>
	        <input type='submit' title='Update account state with selected operation' class='clients_buttons' id='update_account_<?php echo $id_member?>' value='Update account' /><br>
			<div id='update_message_<?php echo $id_member?>'>
		    </div>
			</form>	
			<h4>Send Email</h4>
			<input type='submit' title='Send email only to this member' class='clients_buttons' id='send_email_<?php echo $id_member?>' value='Send email' /><br>
			<div id='sending_email_<?php echo $id_member?>'>
			</div>
		</td>
	</tr>
	<?php
	}
	?>
</table>
<?php
}
else
{
	if(!empty($keyword))
	{
	$error_message="'$keyword' not found "	;
	}
	else
	{
	$error_message="No member found!"	;
	}
	
}
}
elseif($operation=='update_account')
{
$button_id=htmlentities($_GET['button_id']);
		if(isset($_POST['operations']))
		{
		$idm=$button_id;
		$member=new dj_member("*","id_member='$idm'");//
		$imprint=$member->GET_imprint();
		$ident_registration=$member-> getIdentification($imprint,$identRegistration);
		$ident_Activation=$member-> getIdentification($imprint,$identActivation);
		$ident_banning=$member-> getIdentification($imprint,$identBan);
		$operation=htmlentities($_POST['operations']);
		switch($operation)
		{
		case '':
		$info_message= 'Select option';
		/*$update_state=false;
		$ident_update_account=false;*/
		break;	
		 
		case 'deactivate':
		$update_state=$member->UPDATE_ident($ident_registration);
		$ident_update_account=$member->UPDATE_account(0);
		break;	

		case 'activate':
		$update_state=$member->UPDATE_ident($ident_Activation);
		$ident_update_account=$member->UPDATE_account(10);
		break;	

		case 'ban':
		$update_state=$member->UPDATE_ident($ident_banning);
	    $ident_update_account=$member->UPDATE_account(-10);
		break;	
		}
		//$ident_update_account=false;
		//var_dump($update_state);
		//var_dump($ident_update_account);
		if(isset($update_state) AND isset($ident_update_account))
		{
		if($update_state AND $ident_update_account)
		{
		$succes_message='Updated successfully';	
		}
		else
		{
		$error_message= 'Fail to updated account';
		}
		}
		}
}
elseif($operation=='send_email' )
{
$button_id=htmlentities($_GET['button_id']);

		$dj_table=new dj_table($Option_Table);
		$emailer_data=$dj_table->Read_Table_Data("*","id_option=1");
		$emailer_data=$emailer_data[0]["option_content"];
		eval('$emailer='.$emailer_data);
		$Sender=$emailer['Sender'] ;
  		$From=$emailer['From'];
  		$Reply=$emailer['Reply'] ;
  		$Cc_Email=$emailer['Cc_Email'] ;
 		$Bcc_Email=$emailer['Bcc_Email'];
 		$Activation_Message=$emailer['Activation_Message'];
		//$email_title=$_POST['email_title'];
		if(isset($_POST['email_title']))
		{
		$email_title=trim(htmlentities($_POST['email_title']));
		$_SESSION['email_title']=$email_title;	
		}
		else
		{
		$email_title=$_SESSION['email_title'];
		}
		//$email_html=$_POST['email_html'];//htmlspecialchars
		if(isset($_POST['email_html']))
		{
		//$email_html=htmlspecialchars($_POST['email_html']);
		$email_html=trim(htmlentities($_POST['email_html']));
		$email_html=html_entity_decode($email_html);
		
		$_SESSION['email_html']=$email_html;	
		}
		else
		{
		$email_html=$_SESSION['email_html'];
		}
		/*TEMP******************************************************************************************************************************************************************************************************************************************/
		/*TEMP******************************************************************************************************************************************************************************************************************************************/
		/*TEMP******************************************************************************************************************************************************************************************************************************************/
		$email_plain=preg_replace("#(<.*>)*#U","",$email_html);
		// var_dump($email_plain);
		/*TEMP***************************************************************************************************************************************************************/
		/*TEMP***************************************************************************************************************************************************************/
		/*TEMP***************************************************************************************************************************************************************/
		
		//$email_plain=$_POST['email_plain'];
		/*if(isset($_POST['email_plain']))
		{
		//$email_plain=htmlspecialchars($_POST['email_plain']);
		$email_plain=$_POST['email_plain'];
		$_SESSION['email_plain']=$email_plain;	
		}
		else
		{
		$email_plain=$_SESSION['email_plain'];
		}*/
		$headers=  Array(
		'from_email'=>$From,
		'from_name'=>$Sender,
		'reply_to_emails'=>explode($Reply,","), 
		'reply_to_names'=>array('',''),
		'CC'=>explode($Cc_Email,","), 
		'BCC'=>explode($Bcc_Email,",")); 

		/*$smtp_custom=Array('host'=>'smtp.gmail.com',
		'SMTPAuth'=>true,
		'username'=>'Ahmed.gsm1983@gmail.com',
		'password'=>'09019083AhmedGsm',
		'SMTPSecure'=>'tls',
		'port'=>587); */
		$smtp_custom=false;

		$subject=$email_title;//$_POST['email_title'];
		$attachments_files="";

		$dj_emailer	=new dj_emailer($Sender, $From,$Reply,$Cc_Email,$Bcc_Email);
		if($button_id=='ALL'){
		
			$precisions="id_member>0";
			$table=new dj_table($Registration_Table);
			$members=$table->Read_Table_Data("*",$precisions);
			/*TEMP*//*TEMP*//*TEMP*//*TEMP*/
			//$members=false;
			/*TEMP*//*TEMP*//*TEMP*//*TEMP*/
			//var_dump($members);
			/*TEMP*$members=array();/*TEMP*/
			if(!empty($members))
			{
				//$table=new dj_table($Registration_Table);
   				$dataRead=$table-> Read_Table_Data('email','');
				for($i=0;$i<sizeof($dataRead);$i++)
				{
				$email=$dataRead[$i]['email'];
				$destinations[]=$email;
				}
				//var_dump($destinations);
				//$sendState=$dj_emailer->Send_Email($email,$email_title, $email_plain,$email_html);
				$sendState=$dj_emailer->Send_Email_EX($headers,$smtp_custom,$destinations,$subject,$email_html,$email_plain/*,$attachments_files*/);
				
			}
			else
			{
			$error_message="No member registered, no email sent";
			}
		}
		else
		{
			var_dump($button_id);
 			$member=new dj_member("email","id_member='$button_id'");//
			$email=$member->GET_email();
			$destinations=array($email);
			// $sendState=$dj_emailer->Send_Email($email,$subject, $email_plain,$email_html);
			//$sendState=$dj_emailer->Send_Email_EX($email,$email_title, $email_plain,$email_html);
			 $sendState=$dj_emailer->Send_Email_EX($headers,$smtp_custom,$destinations,$subject,$email_html,$email_plain,$attachments_files);
		}
		
		if(isset($sendState) AND $sendState)
		{
		$succes_message='Message successfully sent';
		}
		elseif(isset($sendState) AND $sendState)
		{
		$error_message="Fail to send email, please check SMTP server";
		}
}
if(isset($error_message))
{
?>
<div id="fail">
	<div><img src="icons/error.png"/></div>
	<div><?php echo $error_message ?></div>
</div >

<?php
}
if(isset($info_message))
{
?>
<div id="info">
	<div><img src="icons/warning.png" ></div>
	<div><?php echo $info_message?></div>
</div>
<?php
}
if(isset($succes_message))
{
?>
	<div id="success">
	<div><img src="icons/correct.png"/></div>
	<div><?php echo $succes_message?></div>
	</div >
<?php
}
?>
