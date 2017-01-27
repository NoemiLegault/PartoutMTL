<!-- PAGE SOUMISSION D'UNE OEUVRE USAGER, TABLE Soumissions ----------------------------------------->


<section class="column centre soumissionUsager">
    
    <h1 class="">Suggérer une oeuvre</h1>
    
    <section class="soumissionUsagerFormulaire" >
        
        <label for="titreOeuvreSoumissionUsager"><span class="couleurErreurSoumission">Titre : </span></label>
        <input type="text" name="titreOeuvreSoumission" id="titreOeuvreSoumissionUsager"/>
        
        <label for="prenomOeuvreSoumissionUsager">Prénom : </label>
        <input type="text" name="prenomArtisteOeuvreSoumission" id="prenomOeuvreSoumissionUsager"/>

        <label for="nomArtisteOeuvreSoumissionUsager">Nom : </label>
        <input type="text" name="nomArtisteOeuvreSoumission" id="nomArtisteOeuvreSoumissionUsager"/>
        
        <label for="collectifOeuvreSoumissionUsager">Collectif : </label>
        <input type="text" name="collectifOeuvreSoumission" id="collectifOeuvreSoumissionUsager"/>
        
        <label for="arrondissementOeuvreSoumissionUsager">Arrondissement : </label>
        <select name="arrondissementOeuvreSoumission" id="arrondissmentOeuvreSoumissionUsager">
			<option value="#">Options</option>
            <?php
			/*-- RÉCUPÈRE LES DONNÉES DE LA TABLE Arrondissements -----------------------------------*/
			foreach($data as $arrondissement)                                       
			{
				?>
				<option value="<?php echo $arrondissement['idArrondissement']?>"> <?php echo $arrondissement["nomArrondissement"]?></option>
				<?php
			}
			?>
        </select>
        
        <label for="parcOeuvreSoumissionUsager">Parc : </label>
        <input type="text" name="parcOeuvreSoumission" id="parcOeuvreSoumissionUsager"/>
        
        <label for="adresseCiviqueOeuvreSoumissionUsager">Adresse civique : </label>
        <input type="text" name="adresseCiviqueOeuvreSoumission" id="adresseCiviqueOeuvreSoumissionUsager" multiple/>
        
        <label for="descriptionOeuvreSoumissionUsager">Description : </label>
        <textarea rows="4" style="margin-bottom: 10px; width: 337px;" name="descriptionOeuvreSoumission" id="descriptionOeuvreSoumissionUsager"></textarea>
        
        <!-- SOUMISSION D'UNE PHOTO (JPEG SEULEMENT) ------------------------------------------------->
         
        <!-- sources :  https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire 
                        http://blog.teamtreehouse.com/uploading-files-ajax  
                        https://developer.mozilla.org/fr/docs/Web/API/FormData
                        http://php.net/manual/fr/features.file-upload.post-method.php ---------------->
        
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <label for="photoOeuvreSoumissionUsager">Photo (.jpg) : </label>
        <input type="file" name="photoOeuvreSoumission" id="photoOeuvreSoumissionUsager" accept="image/jpeg"/>
    
        <label for="courrielOeuvreSoumissionUsager"><span class="couleurErreurSoumission">Votre courriel : </span></label>
        <input type="text" name="courrielOeuvreSoumission" id="courrielOeuvreSoumissionUsager"/>

        <span id="msgErreurSoumision"></span>

    </section>
    
    <input type="button" class="boutonSoummissionUsager" id="boutonSoumission" value="SOUMETTRE" name="boutonSoumission"/>   
</section>
        
        