<?php
include_once('Store.Class.php');
include_once('Table.Class.php');
if(file_exists("Data.php"))
{
include_once("Data.php");
}/*
else
{
include_once("Data.php");	
}*/
class dj_member
{
private $id_member;	
private $first_name;	
private $last_name;	
private $age;	
private $birth_date;	
private $gender;	
private $pseudonym;	
private $email;	
private $telephone;	
private $country;	
private $address;	
private $post_code;	
private $paypal;	
private $credit_card;	
private $CSV;	
private $time_zone;	
private $register_date;	
private $imprint;	
private $ident;	
private $merge;	
private $hash_type;	
private $account;	
private $dj_table;	

public function __construct($fieldsList,$precisions)
{
	global $Registration_Table;
	if( !empty($fieldsList) )
	{
		$this->dj_table=new dj_table($Registration_Table);
   		$dataRead=$this->dj_table-> Read_Table_Data($fieldsList,$precisions);
			if(isset($dataRead[0]["id_member"]))
			{
			$this->id_member=$dataRead[0]["id_member"];
			}

			if(isset($dataRead[0]["first_name"]))
			{
			$this->first_name=$dataRead[0]["first_name"];
			}
			
			if(isset($dataRead[0]["last_name"]))
			{
			$this->last_name=$dataRead[0]["last_name"];
			}	
			
			if(isset($dataRead[0]["age"]))
			{
			$this->age=$dataRead[0]["age"];
			}
			
			if(isset($dataRead[0]["birth_date"]))
			{
			$this->birth_date=$dataRead[0]["birth_date"];
			}
			
			if(isset($dataRead[0]["gender"]))
			{
			$this->gender=$dataRead[0]["gender"];
			}
			
			if(isset($dataRead[0]["pseudonym"]))
			{
			$this->pseudonym=$dataRead[0]["pseudonym"];
			}
			
			if(isset($dataRead[0]["email"]))
			{
			$this->email=$dataRead[0]["email"];
			}
			
			if(isset($dataRead[0]["telephone"]))
			{
			$this->telephone=$dataRead[0]["telephone"];
			}
			
			if(isset($dataRead[0]["country"]))
			{
			$this->country=$dataRead[0]["country"];
			}
			
			if(isset($dataRead[0]["address"]))
			{
			$this->address=$dataRead[0]["address"];
			}
			
			if(isset($dataRead[0]["post_code"]))
			{
			$this->post_code=$dataRead[0]["post_code"];
			}
			
			if(isset($dataRead[0]["paypal"]))
			{
			$this->paypal=$dataRead[0]["paypal"];
			}
			
			if(isset($dataRead[0]["credit_card"]))
			{
			$this->credit_card=$dataRead[0]["credit_card"];
			}
			
			if(isset($dataRead[0]["CSV"]))
			{
			$this->CSV=$dataRead[0]["CSV"];
			}
			
			if(isset($dataRead[0]["time_zone"]))
			{
			$this->time_zone=$dataRead[0]["time_zone"];
			}
			
			if(isset($dataRead[0]["register_date"]))
			{
			$this->register_date=$dataRead[0]["register_date"];
			}
			
			if(isset($dataRead[0]["imprint"]))
			{
			$this->imprint=$dataRead[0]["imprint"];
			}
			
			if(isset($dataRead[0]["ident"]))
			{
			$this->ident=$dataRead[0]["ident"];
			}
			
			if(isset($dataRead[0]["merge"]))
			{
			$this->merge=$dataRead[0]["merge"];
			}
			
			if(isset($dataRead[0]["hash_type"]))
			{
			$this->hash_type=$dataRead[0]["hash_type"];
			}
			
			if(isset($dataRead[0]["account"]))
			{
			$this->account=$dataRead[0]["account"];
			}
	}
}
public function sessions_Initialization()
{
			$_SESSION["account"]=$this->account;
			$_SESSION["hash_type"]=$this->hash_type;
			$_SESSION["merge"]=$this->merge;
			$_SESSION["ident"]=$this->ident;
			$_SESSION["imprint"]=$this->imprint;
			$_SESSION["register_date"]=$this->register_date;
			$_SESSION["time_zone"]=$this->time_zone;
			$_SESSION["CSV"]=$this->CSV;
			$_SESSION["credit_card"]=$this->credit_card;
			$_SESSION["paypal"]=$this->paypal;
			$_SESSION["post_code"]=$this->post_code;
			$_SESSION["address"]=$this->address;
			$_SESSION["country"]=$this->country;
			$_SESSION["telephone"]=$this->telephone;
			$_SESSION["pseudonym"]=$this->pseudonym;
			$_SESSION["gender"]=$this->gender;
			$_SESSION["birth_date"]=$this->birth_date;
			$_SESSION["age"]=$this->age;
			$_SESSION["last_name"]=$this->last_name;
			$_SESSION["first_name"]=$this->first_name;
			$_SESSION["id_member"]=$this->id_member;
			$_SESSION["email"]=$this->email;
}
public function getHashType()
{
global $Option_Table; 
$store=new dj_store();
$Sql_Operation="SELECT * FROM {$Option_Table}";
$hashType=$store-> Sql_Operation($Sql_Operation) ;
$hashType = $hashType[1]['option_content'];
return $hashType ;
}	


public function getImprintMerge() 
{
$salt ='';
for ($i=0; $i<15; $i++ )
{
$rand=	rand(33,127) ;
$salt .=chr($rand);
}
$salt=str_replace('\'','#',$salt);
$salt=str_replace('"','#',$salt);
return $salt;
}	
public function getImprintHash($cleared,$merge,$HashType )
{
global $pass_merge;
$cleared=$pass_merge.$cleared;
switch($HashType)
{

case '1':
$ImprintHash=sha1(md5($cleared.$merge ) );
break;

case '2':
$ImprintHash=sha1(md5($cleared).$merge );
break;

case '3':
$ImprintHash=sha1($cleared.$merge );
break;

case '4':
$ImprintHash=md5($cleared.$merge );
break;

default:
$action='';
}
return $ImprintHash ;
}

public function getIdentification($cleared,$identMerge)
{
 $MemberIdentification=sha1( $cleared.$identMerge);
return $MemberIdentification;
}	
//GETTERS
public function GET_id_member()
{
return $this->id_member;
}	

public function GET_first_name()
{
return $this->first_name;
}	

public function GET_last_name()
{
return $this->last_name;
}		

public function GET_age()
{
return $this->age;
}	

public function GET_birth_date()
{
return $this->birth_date;
}	

public function GET_gender()
{
return $this->gender;
}		

public function GET_pseudonym()
{
return $this->pseudonym;
}	

public function GET_email()
{
return $this->email;
}	

public function GET_telephone()
{
return $this->telephone;
}	

public function GET_country()
{
return $this->country;
}	

public function GET_address()
{
return $this->address;
}	

public function GET_post_code()
{
return $this->post_code;
}		

public function GET_paypal()
{
return $this->paypal;
}	

public function GET_credit_card()
{
return $this->credit_card;
}	

public function GET_CSV()
{
return $this->CSV;
}	

public function GET_time_zone()
{
return $this->time_zone;
}	

public function GET_register_date()
{
return $this->register_date;
}	

public function GET_imprint()
{
return $this->imprint;
}	

public function GET_ident()
{
return $this->ident;
}	

public function GET_merge()
{
return $this->merge;
}	

public function GET_hash_type()
{
return $this->hash_type;
}	

public function GET_account()
{
return $this->account;
}	

// UPDATERS********
 	public function UPDATE_id_member($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("id_member='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_first_name($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("first_name={$newVlaue}","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_last_name($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("last_name='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}	

 	public function UPDATE_age($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("age='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_birth_date($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("birth_date='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_gender($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("gender='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}	

 	public function UPDATE_pseudonym($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("pseudonym='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_email($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("email='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_telephone($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("telephone='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_country($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("country='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_address($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("address='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}	

 	public function UPDATE_post_code($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("post_code='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}	

 	public function UPDATE_paypal($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("paypal='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_credit_card($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("credit_card='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_CSV($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("CSV='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_time_zone($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("time_zone='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_register_date($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("register_date='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_imprint($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("imprint='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_ident($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("ident='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}	

 	public function UPDATE_merge($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("merge='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}

 	public function UPDATE_hash_type($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("hash_type='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}
	
 	public function UPDATE_account($newVlaue)
	{ 
    $returnValue=$this->dj_table->Modify_Table_Data("account='{$newVlaue}'","id_member={$this->id_member} ");
	return $returnValue;
	}
}
