<?php
if(file_exists("../Config.php"))
include_once("../Config.php");
class dj_store
{
	
public function __construct() 
{
}
public function Open_DataBase() 
{
global $dbdriver,$dbhost,$user,$pass,$Base_name; 
$dbh = new PDO("{$dbdriver}:host={$dbhost};dbname={$Base_name}", $user, $pass);
	return $dbh;
}
public function Sql_Operation($Sql_Operation) 
{
	$dbh=$this-> Open_DataBase();

		$sth = $dbh->prepare($Sql_Operation);
		if($sth)
		{
		$execute=$sth->execute();
    		if($execute)
    		{
    		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
			}
			else
			{
			$results=$execute	;	
			}
		}
		else
		{
		$results=$sth	;
		}
 return $results;
}
public function Sql_Operation_WR($Sql_Operation) 
{
    $dbh=$this->Open_DataBase();
    $sth = $dbh->prepare($Sql_Operation);
    $execute=$sth->execute();
 return $execute;
}
public function List_Databases() 
{ 
global $Base_name;
$base_list=array($Base_name);
return $base_list;
}
public function List_Tables($databases) 
{
		$tab_list=array();	
$table_list=$this->Sql_Operation("SHOW TABLES FROM {$databases}");
	$table_in="Tables_in_{$databases}";
	if(!empty($table_list))
	{
	    for($i=0;$i<sizeof($table_list);$i++)
	    {
	    $tab_list[$i]=	$table_list[$i][$table_in];
	    }
	}
return $tab_list;
}
public function List_Tables_Fields($tables,$databases) 
{
$table_fieds_list=$this->Sql_Operation("SHOW COLUMNS FROM {$databases}.{$tables}");
return $table_fieds_list;
}
}