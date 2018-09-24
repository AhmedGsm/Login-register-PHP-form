<?php
	$dj_table=new dj_table($Admin_Table);
	$all_data=$dj_table->Read_Table_Data("*","");
	//var_dump($all_data);
	
	$admin_account=$all_data[0]['account'];
	switch($admin_account){
		case 100:
		$admin_function='Root';
		break;
	}
	$admin_user_name=$all_data[0]['pseudonym'];
	$admin_email=$all_data[0]['email'];
	//$admin_function=$all_data[0][''];

?>
<header>
    <!--<div id=''>
    </div>-->
    <img src='icons/dashboard.png' title='Admin panel'/>
      <div id='admin_details'>
	    <h1>Administrator User Main Dashboard</h1><br>
	    <b>Admin function:</b> <?php echo $admin_function?><br>
	    <b>Admin User name:</b> <?php echo $admin_user_name?><br>
	    <b>Admin Email:</b> <?php echo $admin_email?> <br>
      </div>
   <!-- <div>
    <?php //echo $admin_user_name?>
    </div>-->
    <div id='float_clear'>
    </div>
</header>