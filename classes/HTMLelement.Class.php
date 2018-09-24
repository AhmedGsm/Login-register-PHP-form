<?php
include_once('Store.Class.php');
//include_once('Table.Class.php');
include_once('../Data.php');
class dj_element
{
	private $id_element;
	private $element_name;
	private $label;
	private $regex;
	private $wrong_message;
	private $right_message;
	private $double_message;
	private $html;
	private $display;
	
	public function __construct($fieldsList,$precisions)
	{
		global $HTMLElement_Table;
		$this->dj_table=new dj_table($HTMLElement_Table);
   		$dataRead=$this->dj_table-> Read_Table_Data($fieldsList,$precisions);

			if(isset($dataRead[0]["id_element"]))
			{
			$this->id_element=$dataRead[0]["id_element"];
			}
	
			if(isset($dataRead[0]["element_name"]))
			{
			$this->element_name=$dataRead[0]["element_name"];
			}
	
			if(isset($dataRead[0]["label"]))
			{
			$this->label=$dataRead[0]["label"];
			}
	
			if(isset($dataRead[0]["regex"]))
			{
			$this->regex=$dataRead[0]["regex"];
			}
	
			if(isset($dataRead[0]["wrong_message"]))
			{
			$this->wrong_message=$dataRead[0]["wrong_message"];
			}
	
			if(isset($dataRead[0]["right_message"]))
			{
			$this->right_message=$dataRead[0]["right_message"];
			}
	
			if(isset($dataRead[0]["double_message"]))
			{
			$this->double_message=$dataRead[0]["double_message"];
			}
	
			if(isset($dataRead[0]["html"]))
			{
			$this->html=$dataRead[0]["html"];
			}
	
			if(isset($dataRead[0]["display"]))
			{
			$this->display=$dataRead[0]["display"];
			}
		//}
	}
	//GETTERS
	public function GET_id_element()
	{
		return $this->id_element;
	}

	public function GET_element_name()
	{
		return $this->element_name;
	}

	public function GET_label()
	{
		return $this->label;
	}

	public function GET_regex()
	{
		return $this->regex;
	}

	public function GET_wrong_message()
	{
		return $this->wrong_message;
	}

	public function GET_right_message()
	{
		return $this->right_message;
	}

	public function GET_double_message()
	{
		return $this->double_message;
	}

	public function GET_html()
	{
		return $this->html;
	}

	public function GET_display()
	{
		return $this->display;
	}
	
	//UPDATERS
 	public function UPDATE_id_element($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("id_element='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}
	
 	public function UPDATE_element_name($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("element_name='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}
	
 	public function UPDATE_label($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("label='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}
	
 	public function UPDATE_regex($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("regex='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}
	
 	public function UPDATE_wrong_message($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("wrong_message='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}
	
 	public function UPDATE_right_message($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("right_message='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}
	
 	public function UPDATE_double_message($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("double_message='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}

 	public function UPDATE_html($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("html='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}
	
 	public function UPDATE_display($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("display='{$newVlaue}'","id_element={$this->id_element} ");
	return $returnValue;
	}

	
}