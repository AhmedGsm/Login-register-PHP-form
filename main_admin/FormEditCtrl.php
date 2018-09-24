<?php
include_once('classes/HTMLelement.Class.php');
include_once('classes/Table.Class.php');
if(isset($_GET['form_id']))
{
	var_dump($_POST);
	var_dump($_GET);
	$form_id=htmlentities($_GET['form_id']);
	if(isset($_POST['label']))
	{$label=trim(htmlentities($_POST['label']));
	}
	if(isset($_POST['regex']))
	{$regex=trim(htmlentities($_POST['regex']));
	}
	
	if(isset($_POST['wrong_message']))
	{$wrong_message=trim(htmlentities($_POST['wrong_message']));
	}
	
	if(isset($_POST['right_message']))
	{$right_message=trim(htmlentities($_POST['right_message']));
	}
	if(isset($_POST['double_message']))
	{$doubled_message=trim(htmlentities($_POST['double_message']));
	}
	if(isset($_POST['displayed']))
	{
	$display=htmlentities($_POST['displayed']);
	}
	$dj_table=new dj_table($HTMLElement_Table);
	$dataRead=$dj_table-> Read_Table_Data('*','');
	$dj_element=new dj_element ("*","id_element=$form_id");
    if(isset($_POST['label']))
    {
    $state1=$dj_element->UPDATE_label($label);
    }

    if(isset($_POST['regex']))
    {
    $state2=$dj_element->UPDATE_regex($regex);
    }

    if(isset($_POST['wrong_message']))
    {
    $state3=$dj_element->UPDATE_wrong_message($wrong_message);
    }

    if(isset($_POST['right_message']))
    {
    $state4=$dj_element->UPDATE_right_message($right_message);
    }

    if(isset($_POST['double_message']))
    {
    $state5=$dj_element->UPDATE_double_message($doubled_message);
    }

	var_dump($_GET['checkbox_disabled']);
    if($_GET['checkbox_disabled']=='false')
    {
		if(isset($_POST['displayed']))
		{
		$state6=$dj_element->UPDATE_display('YES');
		}
		else
		{
		$state6=$dj_element->UPDATE_display('NO');
		}
    }
if($state1)
{
	?>
	<div id="success">
		<div><img src="icons/correct.png"/></div>
		<div>Update sucess</div>
	</div>
	<?php
}
else
{
	?>
	<div id="fail">
		<div><img src="icons/error.png"/></div>
		<div>Update failed</div>
	</div >
	<?php
}
}
?>