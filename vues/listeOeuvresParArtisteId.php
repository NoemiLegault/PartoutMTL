﻿<!--Variables pour se retrouver dans le dénombrement des résultats de la variable $data-->
<?php
$precendent = 0;        // permettra de savoir l'ID de l'oeuvre traité précédemment
$nbrePage = 1;          // compte le nombre total de pages
$nbreMaxElement = 20;   //nombre maximum de résultats par pages
$elemCourant = 1;       //Rang d'un élément dans un pages
$elemTotal = 0;         //Nombre total de résultats dans la liste
$tableauAllOeuvres = []; 	//tableau associatif qui contiendra toutes les oeuvres pour ensuite les ordonner en ordre alphabétique
$sansTitreIndex = 1;

//On construit le tableau de toutes les oeuvres qu'on mettra en ordre alphabétique après
foreach($data[0] as $photo)
{	
	$precendent = $photo["idOeuvre"];
	$listeAuteur = []; 		//tableau qui contiendra tous les auteurs
	$titreConstruit = "";	//titre en voie de construction
	
	//on crée un tableau vide dans $tableauAllOeuvres qui a le titre de l'oeuvre comme clé (pour les ordonner alphabétiquement plus tard)
	
	if($photo["titre"] == "Sans titre")
	{
		$titreConstruit = $photo["titre"].$sansTitreIndex;
		$sansTitreIndex++;
	}
	else
	{
		$titreConstruit = $photo["titre"];
	}
	
	$tableauAllOeuvres[$titreConstruit] = [];
	
	if(array_key_exists ( "titre" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["titre"] = $photo["titre"];
	}
	
	// si le tableau  qui a le titre de l'oeuvre comme clé ne contient pas le clé "id" on la crée et on y l'id l'oeuvre
	if(array_key_exists ( "idOeuvre" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["idOeuvre"] = $photo["idOeuvre"];
	}
	
	// si le tableau  qui a le titre de l'oeuvre comme clé ne contient pas le clé "url" on la crée et on y l'URL de la photo de l'oeuvre
	if(array_key_exists ( "urlPhoto" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["urlPhoto"] = $photo["urlPhoto"];
	}
	
	// si le tableau  qui a le titre de l'oeuvre comme clé ne contient pas le clé "annee" on la crée et on y insère l'année de création de l'oeuvre
	if(array_key_exists ( "dateFinProduction" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["dateFinProduction"] = $photo["dateFinProduction"];
	}
	
	//On construit la liste des auteurs
	foreach($data[1] as $oeuvre)
	{
		if($oeuvre["idOeuvre"] == $precendent)
		{

			$nom = ""; //nom à rentrer dans la liste d'auteur
			
			if($oeuvre["prenomArtiste"] != "")
			{
				$nom = $oeuvre["prenomArtiste"];
				
				if($oeuvre["nomArtiste"] != "")
				{
					$nom = $nom." ".$oeuvre["nomArtiste"];
				}
			}
			
			else if($oeuvre["nomArtiste"] != "")
			{
				$nom = $oeuvre["nomArtiste"];
			}
			
			else if($oeuvre["collectif"] != "" && ($oeuvre["prenomArtiste"] == "" && $oeuvre["nomArtiste"] == ""))
			{
				$nom = $oeuvre["collectif"]." (collectif)";
			}
			
			array_push($listeAuteur,$nom);
		}
		
	}
	
	// si le tableau  qui a le titre de l'oeuvre comme clé ne contient pas le clé "auteur" on la crée et on y l'URL de la photo de l'oeuvre
	if(array_key_exists ( "auteur" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["auteur"] = $listeAuteur;
	}
}
ksort($tableauAllOeuvres);
//print_r($tableauAllOeuvres);
//print_r($data[2]);
?>

<!--Construire la liste en divisant les résultats en page de 20 résultats-->
<section id="liste">
	<h1 id="oeuvres" >Liste des oeuvres</h1> <!-- id pour recherche -->
	<span class="pageBalise" id="1">
	<?php
		if(count($data[2]) <= 20)
		{
			echo "Résultats 1 à ".count($data[2]);
		}
		else
		{
			echo "Résultats 1 à 20";
		}
	?>
	</span>
	<div class="pageListe" id="page1">
	<?php
		foreach($tableauAllOeuvres as $oeuvre)
		{
			foreach($data[2] as $oeuvreID)
			{
				//echo $oeuvreID;
				if($oeuvre["idOeuvre"] == $oeuvreID)
				{
					?>
						<div class="elemListe">
							<a href="./index.php?requete=afficheOeuvre&idOeuvre=<?php echo $oeuvre["idOeuvre"]?>">
								<img src="
									<?php 
										if($oeuvre["urlPhoto"] != null)
										{
											echo $oeuvre["urlPhoto"];
										}
										else if($oeuvre["urlPhoto"] == null || $oeuvre["urlPhoto"] == "")
										{
											echo "http://galaxy.mobity.net/uploads/148/logo/1399898656.png";
										}
									?>
								">
								<ul>
									<li><span class="catElemListe">Titre : </span><?php echo $oeuvre["titre"]?></li>
									<li><span class="catElemListe">Année : </span><?php echo $oeuvre["dateFinProduction"]?></li>
									<li><span class="catElemListe">Auteur(s):</span>
										<ul class="listeAuteur">
											<?php
											foreach($oeuvre["auteur"] as $artiste)
											{	
												?>
													<li><?php echo $artiste ?></li>
												<?php
											}
											?>
										</ul>
									</li>
								</ul>
							</a>
						</div>
					<?php
					
					$elemTotal++;
					$elemCourant++;
					if($elemCourant > $nbreMaxElement)
					{
						$nbrePage++;
						$elemCourant = 1;
						?>
							</div>
							<span class="pageBalise" id="<?php echo $nbrePage;?>">
							<?php
								echo"Résultats ".($elemTotal+1)." à ".($elemTotal+$nbreMaxElement);
							?>
							</span>
							<div class="pageListe pageCache" id="<?php echo "page".$nbrePage;?>">
						<?php	
					}	
				}		
			}
		}
	?>
</section>