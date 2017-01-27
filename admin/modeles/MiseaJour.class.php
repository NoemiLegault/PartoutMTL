<?php
date_default_timezone_set('America/Toronto');//Obtenir l'heure avec la zone Toronto (functionne pour Montr�al aussi) pour ce script

/**
 * Class Modele
 * Mod�le de classe mod�le. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du d�partement de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */
class MiseaJour extends TemplateBase 
{
	protected function getPrimaryKey()
	{
		return "idMiseAJour";
	} 
	 
	public function getTable()
	{
		return "MiseAJours";
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      SELECT      /////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////// 
	
	
	public function obtenirXenregistrement($nEnrg,$table,$cle)
	{
		try
		{
			if($table == null)
			{
				$table = $this->getTable();
			}
            $stmt = $this->connexion->prepare("SELECT * FROM " . $table . " ORDER BY " . $cle ." DESC LIMIT ".$nEnrg);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      INSERT     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
	
	public function insererMiseAJour($date,$nOeuvres,$usager)
	{
		try
		{	
			$stmt = $this->connexion->prepare("INSERT INTO ".$this->getTable()."(dateMiseAJour,nbOeuvres,nomUsagerAdmin) VALUES (:date, :oeuvres, :usager)");
			$stmt->execute(array(
			
				"date"				=>$date,
				"oeuvres"			=>$nOeuvres,
				"usager"			=>$usager
			
			));
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      M�THODES     ////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
	
	
	public function enregistrement($donnes)
	{	
		$momentImportation = date("Y-m-d H:i:s");// obtienne le moment de l'importation de donn�s pour le garder dans la table des historiques
		$this->insererMiseAJour($momentImportation,$donnes["OeuvresTotal"],$_SESSION['authentifie']);
	}
	
}

?>