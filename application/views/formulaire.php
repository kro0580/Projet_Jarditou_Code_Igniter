<?php
include("entete.php");

echo validation_errors('<div class="alert alert-danger">','</div>');

?>

<!-- CONTENU DE MA PAGE -->

<p class="noir"><b>* Ces zones sont obligatoires</b></p>
        
        <div class="row">
            <!-- class="was-validated pour avoir les couleurs vertes et rouges du formulaire -->
            <!-- Action en post pour envoyer vers le fichier PHP -->
            <?php echo form_open("produits/ajout_contact", array('class' => 'col-lg-12')); ?>
            
                    <fieldset>
            
                        <legend>Vos Coordonnées</legend>
    
            <!-- class="form-group" et class="form-control" pour présentation du formulaire avec Bootstrap -->
                        <div class="form-group">
                        <label for="nom">Votre nom<b>*</b></label>
            <!-- required pour rendre la saisie obligatoire - A remettre pour le JS une fois que l'on a testé le PHP-->
                            <input type="text" class="form-control" name="nom" id="nom">
                            <span id="alert1"></span> <!-- Affichage du message d'erreur jQuery dans le formulaire -->
                        </div>
                        
                        <div class="form-group">
                        <label for="prenom">Votre prénom<b>*</b></label>
                            <input type="text" class="form-control" name="prenom" id="prenom">
                            <span id="alert2"></span>
                        </div>
    
                        <label for=sexe>Sexe<b>*</b></label>
    
                        <div class="form-check">
                                <input class="form-check-input" type="radio" value="masculin" id="sexe_ma" name="customRadio">
                                <label class="form-check-label" for="sexe">Masculin</label>
                        </div>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" value="feminin" id="sexe_fe" name="customRadio">
                                <label class="form-check-label" for="sexe">Féminin</label>
                        </div><br>
                        <span id="alert3"></span>
    
                        <div class="form-group">
                        <label for="naissance">Date de Naissance<b>*</b></label>
                            <input type="date" max="date.toLocaleDateString()" min="1900-01-01" class="form-control" name="naissance" id="naissance">
                            <span id="alert4"></span>
                        </div>

                        <div class="form-group">
                        <label for="adresse">Adresse<b>*</b></label>
                            <input type="text" class="form-control" name="adresse" id="adresse">
                            <span id="alert5"></span>
                        </div>
    
                        <div class="form-group">
                        <label for="code_postal">Code postal<b>*</b></label>
                            <input type="text" class="form-control" name="code_postal" id="code_postal">
                            <span id="alert6"></span>
                        </div>
    
                        <div class="form-group">
                        <label for="ville">Ville<b>*</b></label>
                            <input type="text" class="form-control" name="ville" id="ville">
                            <span id="alert7"></span>
                        </div>
                        
                        <div class="form-group">
                        <label for="email">Email<b>*</b></label>
                            <input type="text" class="form-control" placeholder="dave.loper@afpa.fr" name="email" id="email">
                            <span id="alert8"></span>
                        </div>
    
                    </fieldset><br>
    
                    <fieldset>
                        
                        <legend>Votre demande</legend>
    
                        <div class="form-group">
                        <label for="sujet">Sujet<b>*</b></label>
                        <select class="selectpicker form-control" name="demande" size="1" id="sujet">
                            <option value="">--- Choisissez un item ---</option>
                            <option value="commandes">Mes commandes</option>
                            <option value="questions">Question sur un produit</option>
                            <option value="reclamation">Réclamation</option>
                            <option value="autres">Autres</option>
                        </select>
                        </div>
                        <span id="alert9"></span>
                    
                        <div class="form-group">
                            <label for="question">Votre question<b>*</b></label>
                            
                            <textarea class="form-control" id="question" name="question" id="question"></textarea>
                            <span id="alert10"></span>
                        </div>
    
                    </fieldset>
    
        <div class="form-group custom-control custom-checkbox">
            <input type="checkbox" name="accord" value="accord" class="custom-control-input" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">J'accepte le traitement informatique de ce formulaire</label>
        </div>
        <span id="alert11"></span>
        
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Envoyer" id="bouton_envoi">
            <input type="reset" class="btn btn-danger" value="Annuler">
        </div>
    
        </form>
    
        </div>

    <!-- PIED DE PAGE -->

<?php
include("pieddepage.php");
?>

<!-- Script jQuery -->
<script src="<?php echo base_url("assets/js/formulaire_jquery.js");?>"></script>

