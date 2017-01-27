<!-- PAGE GESTION AJOUTER UNE CATÉGORIE, TABLE Categories -------------------------------------------> 


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>


<div class="categorie marginDivPrincipale adminTitre"> 
    <h1>CATÉGORIES</h1>
    <section class="flex-row-left">
        
        <!-- AJOUTER UNE CATÉGORIE ------------------------------------------------------------------->
        <article class="espaceADroite10">
            <h3>AJOUTER UNE CATÉGORIE</h3>
            <label for="AjoutCategorieAdmin" class="labelCategorie">Nom : </label>
            <input type="text" name="categorieAjout" id="AjoutCategorieAdmin"/>
            <input type="button" class="bouton2" id="boutonAjoutCategorie" value="AJOUTER" name="boutonAjoutCategorie"/>
        </article>
    
        <!-- SUPPRIMER UNE CATÉGORIE ----------------------------------------------------------------->
        <article class="espaceHaut30">
            <h3>SUPPRIMER UNE CATÉGORIE</h3>
            <select name="categorieSuppression" id="SuppressionCategorieAdmin" class="labelCategorie">
	   		<option value="#">Options</option>
                <?php
	   		/*-- pour toutes les datas récupérées de la table Catégories ----------------------------*/
	   		foreach($data as $categorie)
	   		{
	   			?>
	   			<option value="<?php echo $categorie['idCategorie']?>"> <?php echo $categorie["nomCategorie"]?> </option>
	   			<?php
	   		}
	   		?>
            </select>
            <input type="button" class="bouton2" id="boutonSuppressionCategorie" value="SUPPRIMER" name="boutonSuppressionCategorie"/> 
        </article> 
    </section>
    <span id="msgErreurSoumision"></span>
</div>