<?php	
include_once('Data.php');
include_once('classes/Table.Class.php');
		$dj_table=new dj_table($HTMLElement_Table);
		$data_Read=$dj_table->Read_Table_Data("element_name,regex,right_message,wrong_message,double_message,display","");
		if(isset($_GET['request']))
		{
		$request=htmlentities($_GET['request']);//trim(htmlentities)
			if($request=='load_messages')
			{
				$messages=json_encode($data_Read);
				echo $messages;
			}
		}
		
		
?>
