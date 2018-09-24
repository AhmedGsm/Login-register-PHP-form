<?php
include_once('classes/Table.Class.php');
include_once('Data.php');
if(isset($_GET['request']))
{
$sender=trim(htmlentities($_POST['sender']));
$from=trim(htmlentities($_POST['from']));
$replyto=trim(htmlentities($_POST['replyto']));
$cc_email=trim(htmlentities($_POST['cc_email']));
$bcc_email=trim(htmlentities($_POST['bcc_email']));
$activation_message=trim(htmlentities($_POST['activation_message']));
$hash_type=htmlentities($_POST['hash_type']);
$login_with=htmlentities($_POST['login_with']);
$login_page=trim(htmlentities($_POST['login_page']));
$logout_page=trim(htmlentities($_POST['logout_page']));
$client_session=trim(htmlentities($_POST['client_session']));
$admin_session=trim(htmlentities($_POST['admin_session']));
$label_conditions=trim(htmlentities($_POST['label_conditions']));


$emailer="array(\"Sender\" =>\"$sender\",	
\"From\" =>\"$from\",
\"Reply\" =>\"$replyto\",
\"Cc_Email\" =>\"$cc_email\",
\"Bcc_Email\" =>\"$bcc_email\",
\"Activation_Message\" =>\"$activation_message\",
);";
/*$d_table=new dj_table($HTMLElement_Table);
$data_Read=$d_table->Read_Table_Data("*","");
if($data_Read[5]['display']=='NO' AND $login_with=='user_name'  ){
$error_message='Update denied because "User name" field hidden in visitor "Register form", display it in "Form edit" page, or set "Login with" to \'Email\' in this page';
}else
{*/
$dj_table=new dj_table($Option_Table);
$update1=$dj_table->Modify_Table_Data("option_content='$emailer'",'id_option=1');
$update2=$dj_table->Modify_Table_Data("option_content='$hash_type'",'id_option=2');
$update3=$dj_table->Modify_Table_Data("option_content='$login_page'",'id_option=3');
$update4=$dj_table->Modify_Table_Data("option_content='$logout_page'",'id_option=4');
$update5=$dj_table->Modify_Table_Data("option_content='$client_session'",'id_option=5');
$update6=$dj_table->Modify_Table_Data("option_content='$admin_session'",'id_option=6');
$update7=$dj_table->Modify_Table_Data("option_content='$label_conditions'",'id_option=7');
$update8=$dj_table-> Modify_Table_Data("option_content='$login_with'",'id_option=8');
/*
echo 'uuuu';*/
//}

/*if( isset($update1))
{*/
//$update1=0;
	if( $update1 AND $update2 AND $update3 AND $update4 AND $update5 AND $update6 AND $update7 AND $update8 ){
	?>
	<div id="success">
		<div><img src="icons/correct.png"/></div>
		<div>Update sucess</div>
	</div >
	<?php
	}
	else{
	$error_message ='Update failed';
	}
//}

if(isset( $error_message )){
	 ?>
	 <div id="fail">
		<div><img src="icons/error.png"/></div>
		<div><?php echo $error_message; ?> </div>
	</div >
	 <?php
	 }
	 
}
?>