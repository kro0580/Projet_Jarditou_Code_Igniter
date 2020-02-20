<?php
include("entete.php");

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d H:i:s"); // Format de date avec codeigniter

echo validation_errors('<div class="alert alert-danger">','</div>');

?>

<h2><b>Inscription</b></h2>

<p class="noir"><b>* Ces zones sont obligatoires</b></p>

<div class="row">

<?php echo form_open("produits/inscription", array('class' => 'col-lg-12')); ?>

<div class="form-group">
                        <label for="nom">Votre nom<b>*</b></label>
            <!-- required pour rendre la saisie obligatoire - A remettre pour le JS une fois que l'on a testé le PHP -->
                            <input type="text" class="form-control" name="nom" id="nom">
                            <span id="alert1"></span> <!-- Affichage du message d'erreur jQuery dans le formulaire --> 
                        </div>
                        
                        <div class="form-group">
                        <label for="prenom">Votre prénom<b>*</b></label>
                            <input type="text" class="form-control" name="prenom" id="prenom">
                            <span id="alert2"></span>
                        </div>

                        <div class="form-group">
                        <label for="email">Votre mail<b>*</b></label>
                            <input type="text" class="form-control" placeholder="dave.loper@afpa.fr" name="email" id="email">
                            <span id="alert3"></span>
                        </div>

                        <div class="form-group">
                        <label for="identifiant">Votre login<b>*</b></label>
                            <input type="text" class="form-control" name="identifiant" id="identifiant">
                            <span id="alert4"></span>
                        </div>

                        <div class="form-group">
                        <label for="password">Votre mot de passe<b>*</b></label>
                        <p style = "font-size : 12px"><em><b>(Il doit comporter de 8 à 15 caractères, au moins une lettre minuscule, au moins une lettre majuscule, au moins un chiffre, au moins un de ces caractères spéciaux : $ @ % * + - _ !)</b></em></p>
                            <input type="password" class="form-control" name="password" id="password">
                            <span id="alert5"></span>
                        </div>

                        <div class="form-group">
                        <label for="conf_password">Confimation de votre mot de passe<b>*</b></label>
                        <p style = "font-size : 12px"><em><b>(Il doit comporter de 8 à 15 caractères, au moins une lettre minuscule, au moins une lettre majuscule, au moins un chiffre, au moins un de ces caractères spéciaux : $ @ % * + - _ !)</b></em></p>
                            <input type="password" class="form-control" name="conf_password" id="conf_password">
                            <span id="alert6"></span>
                        </div>

                        <div class="form-group">
                        <label for="login">Date d'inscription :</label>
                        <input type="text" class="form-control" name="inscription" value ="<?=$date?>" readonly id="inscription">
                        </div>

                        <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Envoyer" id="bouton_envoi2">
                        <input type="reset" class="btn btn-danger" value="Annuler">
                        </div>

</form>    

</div>

<?php
include("pieddepage.php");
?>

<!-- Script jQuery -->
<script src="<?php echo base_url("assets/js/inscription_jquery.js");?>"></script>