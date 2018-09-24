<?PHP
if(file_exists("../Config.php"))
{
include_once("../Config.php");
}
/*
else
{
include_once("Config.php");	
}*/

class dj_table 
{

private $Nom_Table; 
private $requete;
private $BASEDONNEES_Objet;


    public function __construct($Nom_Table)
	{
	$this->Nom_Table=$Nom_Table;
	$this->BASEDONNEES_Objet=$this->Open_DataBase() ;
	}
	
	public function Open_DataBase() 
	{
	global $dbdriver,$dbhost,$user,$pass,$Base_name; 
	$dbh = new PDO("{$dbdriver}:host={$dbhost};dbname={$Base_name}", $user, $pass);
	return $dbh;
	}
	
    public function Read_Table_Data($Liste_Champs_A_Recuperer,$Nom_Champs_Repere_Precision)
	{
		
		if(!empty($Nom_Champs_Repere_Precision))
		{
		$WHERE_Texte=" WHERE {$Nom_Champs_Repere_Precision}";
		}
		else
		{
		$WHERE_Texte="";
		}
		$this->requete=$this->BASEDONNEES_Objet->prepare("SELECT {$Liste_Champs_A_Recuperer} FROM {$this->Nom_Table}{$WHERE_Texte}");
		$Execution=$this->requete->execute();
			if($Execution==TRUE)
			{
			$Donnees_Recuperes=$this->requete->fetchAll(PDO::FETCH_ASSOC);
			}
			else
			{
			$Donnees_Recuperes=FALSE;
			}
		
	return $Donnees_Recuperes;
	
	}
	
    public function Write_Table_Data($Champs_A_Ecrire,$Tableau_Donnees)
    {
		//FOMRER LES POINTS D'INTERROGATION
		$input="";
		$Chars_Combines="?,";
		$Interrogations=str_pad($input, ((sizeof($Tableau_Donnees))*(strlen($Chars_Combines)))-1 , $Chars_Combines);   
		//PREPARATION DE LA REQUETE
		$this->requete=$this->BASEDONNEES_Objet->prepare("INSERT INTO {$this->Nom_Table}({$Champs_A_Ecrire}) VALUES({$Interrogations})");
		//EXECUTION DE LA REQUETE
		$Etat_Enregistrement=$this->requete->execute($Tableau_Donnees );
	return $Etat_Enregistrement;		
	}
	
    public function Modify_Table_Data($Champs_Valeurs,$Champs_Repers)
	{
		$this->requete=$this->BASEDONNEES_Objet->prepare("UPDATE {$this->Nom_Table} SET {$Champs_Valeurs} WHERE {$Champs_Repers}");
		//EXECUTION DE LA REQUETE
		$Etat_Enregistrement=$this->requete->execute();
	return $Etat_Enregistrement;		
	}
	
    public function Delete_Table_Data($Champs_Repers)
	{
			$this->requete=$this->BASEDONNEES_Objet->prepare("DELETE FROM {$this->Nom_Table} WHERE {$Champs_Repers}");
			//EXECUTION DE LA REQUETE
			$Etat_Enregistrement=$this->requete->execute();
	return $Etat_Enregistrement;		
	}
    public function Search_Table_Data($Champs_Reperes)
    {
	//********************
		$Champs_Liste="";
		$signes=array(">","<");
		//REMPLACER LES SIGNE < ET > AVEC =
		$Champs_Reperes_Rect=str_replace($signes,"=",$Champs_Reperes);
		//SEPARER LA REQUETE A PARTIR DES ESPACES 
		$morceaux= explode(" ",$Champs_Reperes_Rect);
	
		for($i=0;$i<sizeof($morceaux);$i++)
		{
		$Tableau_Champs_Egal[$i]=$morceaux[$i];
		//SEPARER LES MORCEAUX A PARTIR DES = 
		$Tableau_Champs_Valeurs[$i]= explode("=",$Tableau_Champs_Egal[$i]);
		$Champs_Liste.=$Tableau_Champs_Valeurs[$i][0].",";
		$i++;
		}
		//ENLEVER LA VIRGULE A LA FIN DE LA CHAINE
		$Champs_Liste = substr($Champs_Liste, 0, -1);  // 

		//PREPARATION DE LA REQUETE
		$this->requete=$this->BASEDONNEES_Objet->prepare("SELECT {$Champs_Liste} FROM {$this->Nom_Table} WHERE {$Champs_Reperes}");//{$Champs_Liste} 
		//EXECUTION DE LA REQUETE
		$Execution=$this->requete->execute();
		$Donnees=$this->requete->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($Donnees);
		if(sizeof($Donnees)>0)
		{
		$Mot_Trouve=TRUE;
		}
		else
		{
		$Mot_Trouve=FALSE;
		}
		//var_dump($Champs_Reperes);

	return $Mot_Trouve;
	}
	
	public function Read_With_SQL_Function($Fonction_SQL,$Nom_Champs_Repere_Precision)
	{
		if(!empty($Nom_Champs_Repere_Precision))
		{
		$WHERE_Texte=" WHERE {$Nom_Champs_Repere_Precision}";
		}
		else
		{
		$WHERE_Texte="";
		}
		$this->requete=$this->BASEDONNEES_Objet->prepare("SELECT {$Fonction_SQL} AS ResultatOperation FROM {$this->Nom_Table}{$WHERE_Texte}");
		$Execution=$this->requete->execute();
		$Donnees=$this->requete->fetch();
		$ResultatOperation=$Donnees["ResultatOperation"];
	return $ResultatOperation;
	}
	
	//LES GETTERS
	public function GET_requete()
	{
	return $this->requete;
	}
    
	public function Close_Curseur()
	{
	$this->requete->CloseCursor();
	}
    
	 public function __destruct()
	{
	//$this->Fermer_Curseur();
	}
	
	

	
}
