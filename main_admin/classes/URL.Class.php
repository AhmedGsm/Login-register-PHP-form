<?PHP
class dj_URL 
{
	private $chaine_Valeurs;
	private $adresse_URL;

	private $Validite_URL;
	//  LE CONSTRUCTEUR DE L'OBJET****************************************
	public function __construct($adresse_URL)
	{
	$this->adresse_URL=$adresse_URL;
	}
	//  VERIFICATION DE LA VALIDITE DE L'URL****************************************
	public function Verifier_Validite_Requete_URL()
	{
		$this->Validite_URL=TRUE;
	return 	$this->Validite_URL;
	}
	//  DECOMPOSITION DE L'URL EN PARAMETRES ET LEURS VALEURS****************************************
	public function Decomposer_Donnees_URL()
	{
		if ($this->Verifier_Validite_Requete_URL())
		{
				//SEPARER l'URL A PARTIR DU SIGNE / (SLASH)
				$tableau_Slashs=explode("/",$this->adresse_URL);
				//SEPARER l'URL A PARTIR DU SIGNE ? (INTERROGATIF)
				$tableau_Interrogatif=explode("?",$this->adresse_URL);
				$Taille_Tabelau_Interrogatif=sizeof($tableau_Interrogatif);
				if($Taille_Tabelau_Interrogatif>1)	//
				{
					//SEPARER l'URL A PARTIR DU SIGNE & (REFERENCE)
					$tableau_Reference=explode("&",$tableau_Interrogatif[1]);
					//SEPARER l'URL A PARTIR DU SIGNE = (EGAL)
					for($index=0;$index<sizeof($tableau_Reference);$index++)
					{
					$tableau_Egalite=explode("=",$tableau_Reference[$index]);
					$tableau_Params[$index]=$tableau_Egalite[0];
					$tableau_Valeurs[$index]=$tableau_Egalite[1];
					}
					$tableau_Generale["SLASH"]= $tableau_Slashs;
					$tableau_Generale["INTERROGATIF"]= $tableau_Interrogatif;
					$tableau_Generale["REFERENCE"]= $tableau_Reference;
					$tableau_Generale["PARAMS"]= $tableau_Params;
					$tableau_Generale["VALEURS"]= $tableau_Valeurs;
				}
				else
				{
				$tableau_Generale="PARAMS_VALEURS_INEXISTANTS";
				}
		}
		else
		{
		$tableau_Generale="FORMAT_URL_INVALIDE";
		}
		
	return $tableau_Generale;
	}
	//  AJOUTER DES PARAMS ET VALEURS****************************************
	public function Ajouter_Params_Valeurs_URL( $tableau_Params_Ajoutes, $tableau_Valeurs_Ajoutes)
	{
		//VERIFIER LA VALIDITE DE L'ADRESSE URL
		if ($this->Verifier_Validite_Requete_URL())
		{
			$taille_Params=sizeof($tableau_Params_Ajoutes);
			$taille_Valeurs=sizeof($tableau_Valeurs_Ajoutes);
		    //VERIFIER LES DEUX TABLEAUX QUE NE SONT PAS VIDES
			if  ($taille_Params>0 AND $taille_Valeurs>0  AND $taille_Params==$taille_Valeurs )
			{
			    //VERIFIER SI L'ADRESSE CONTIENT DEJA DES PARAMETRES ET VALEURS
				$tableau_Interrogatif=explode("?",$this->adresse_URL);
				$Taille_Tabelau_Interrogatif=sizeof($tableau_Interrogatif);
				if($Taille_Tabelau_Interrogatif>1)	//
				{
					for($i=0;$i<sizeof($tableau_Params_Ajoutes);$i++)
					{
					$this->adresse_URL.="&".$tableau_Params_Ajoutes[$i];
					$this->adresse_URL.="=".$tableau_Valeurs_Ajoutes[$i];
					}
				}
				else
				{
					$this->adresse_URL.="?";
					$this->adresse_URL.=$tableau_Params_Ajoutes[0];
					$this->adresse_URL.="=".$tableau_Valeurs_Ajoutes[0];
					for($i=1;$i<sizeof($tableau_Params_Ajoutes);$i++)
					{
					$this->adresse_URL.="&".$tableau_Params_Ajoutes[$i];
					$this->adresse_URL.="=".$tableau_Valeurs_Ajoutes[$i];
					}
				}
			}
			else
			{
			$this->$adresse_URL="TABLEAU_PARAMS_VIDE";
			}
		}
		else
		{
		$this->$adresse_URL="FORMAT_URL_INVALIDE";
		}
	return $this->adresse_URL;
	}
	//  CALCUL DE LA SIGNTURE****************************************
	public function Encrypter_Donnees($sel_URL)
	{
	    $donnees_Encryptes= sha1(md5($sel_URL).sha1($this->chaine_Valeurs));
	return  $donnees_Encryptes;
	}
	//  AJOUTER LA SIGNATURE A L'URL****************************************
	public function Securiser_URL( $nom_Parametre,$sel_URL)
	{
	$tabeau_Generale=$this->Decomposer_Donnees_URL();
		if( $tabeau_Generale!="FORMAT_URL_INVALIDE" AND $tabeau_Generale!="PARAMS_VALEURS_INEXISTANTS")
		{
			foreach($tabeau_Generale["VALEURS"] as $tabeauGenerale)
			{
			$this->chaine_Valeurs.=$tabeauGenerale;
			}
			foreach($tabeau_Generale["PARAMS"] as $tabeauGenerale)
			{
			$this->chaine_Valeurs.=$tabeauGenerale;
			}
			//ENCRYPTAGE DE LA CHAINE DES VALEURS
			$chaine_Valeurs_Encrypte=$this->Encrypter_Donnees($sel_URL);
			//CONCATENER LE PARAM AVEC LA VALEUR CRYPTE ET L'AJOUTER A L'URL
			$tableau_Params_Ajoutes=array($nom_Parametre);
			$tableau_Valeurs_Ajoutes=array($chaine_Valeurs_Encrypte);
	 		$URL_Entrypte=$this->Ajouter_Params_Valeurs_URL( $tableau_Params_Ajoutes, $tableau_Valeurs_Ajoutes);
		}
		else
		{
		$URL_Entrypte=$tabeau_Generale;
		}
		
		$Url_division=explode("?",$URL_Entrypte);
		$Page_PHP=$Url_division[0];
		$query_string=$Url_division[1];
		$query_string_encodee=urlencode($query_string);
		$URL_Entrypte=$Page_PHP."?".$query_string_encodee;
	return $URL_Entrypte;
	}
	//  VARIFICATION DE LA SECURITE DE L'URL****************************************
	public function Verifier_Securite_URL($sel_URL)
	{
	$tabeau_Generale=$this->Decomposer_Donnees_URL();
		if($tabeau_Generale!="FORMAT_URL_INVALIDE" AND $tabeau_Generale!="PARAMS_VALEURS_INEXISTANTS")
		{
		$Taille_Tableau_Valeurs=sizeof($tabeau_Generale["VALEURS"]);
		    for($index=0;$index<$Taille_Tableau_Valeurs-1;$index++)
			{
			$this->chaine_Valeurs.=$tabeau_Generale["VALEURS"][$index]  ;
			}
		    for($index=0;$index<$Taille_Tableau_Valeurs-1;$index++)
			{
			$this->chaine_Valeurs.=$tabeau_Generale["PARAMS"][$index]  ;
			}
			
			//ENCRYPTAGE DE LA CHAINE DES VALEURS
			$chaine_Valeurs_Encrypte=$this->Encrypter_Donnees($sel_URL);
			if($chaine_Valeurs_Encrypte==$tabeau_Generale["VALEURS"][$Taille_Tableau_Valeurs-1])
			{
			$etat_Securite="TRUE";
			}
			else
			{
			$etat_Securite="FALSE";
			}
		}
		else
		{
		$etat_Securite=$tabeau_Generale;
		}
	return $etat_Securite;
	}
	public function __destruct()
	{
	}
}
	

	







