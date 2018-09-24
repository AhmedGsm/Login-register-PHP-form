	<?php
	//var_dump($_SERVER);
	include_once('classes/HTMLelement.Class.php');
	include_once('classes/Table.Class.php');
	$dj_table=new dj_table($HTMLElement_Table);
	$dataRead=$dj_table-> Read_Table_Data('*','');
	$button_Labels=array('First name','Last name','Age',
	'Birth date','Gender','User name','Email','Telephone',
	'Country','Full Address','Post code','PayPal address','Credit card number',
	'Card Security code','Password','Password verification','Time zone',
	'Captcha','Conditions');
	for($i=0;$i<sizeof($dataRead);$i++)
	{
	?>	
	<a href="" class="linked_button" id="button_<?php echo $dataRead[$i]['id_element']?>" title="Click to show & update regex & messages"><?php echo $button_Labels[$i]?></a>	
	<div id='elem_form'>
	</div>
	<?php		
	}
	?>
	<script src="Formedit.js"></script>