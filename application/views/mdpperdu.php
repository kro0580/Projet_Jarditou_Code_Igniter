<?php
include("entete.php");

echo validation_errors('<div class="alert alert-danger">','</div>');

?>

<?php echo form_open("produits/mdp_perdu"); ?>

<h4>Changement du mot de passe</h4>

<div class="form-group"></br>

        <div class="form-group">
            <label for="mail">Votre Email<b>*</b></label>
            <input type="text" class="form-control" placeholder="Veuillez indiquer votre adresse mail" name="mail" id="mail" />
            <span id="alert1"></span>
        </div>

        <div class="form-group">
            <label for="mot_de_passe">Votre nouveau mot de passe<b>*</b></label>
            <p style="font-size : 12px"><em><b>(Il doit comporter de 8 à 15 caractères, au moins une lettre minuscule, au
                    moins une lettre majuscule, au moins un chiffre, au moins un de ces caractères spéciaux : $ @ % * +
                    - _ !)</b></em></p>
            <input type="password" class="form-control" placeholder="Veuillez indiquer votre nouveau mot de passe" name="mot_de_passe" id="mot_de_passe" />
            <span id="alert2"></span>
        </div>

        <div class="form-group">
            <label for="conf_password">Confirmation de votre nouveau mot de passe<b>*</b></label>
            <p style="font-size : 12px"><em><b>(Il doit comporter de 8 à 15 caractères, au moins une lettre minuscule, au
                    moins une lettre majuscule, au moins un chiffre, au moins un de ces caractères spéciaux : $ @ % * +
                    - _ !)</b></em></p>
            <input type="password" class="form-control" placeholder="Veuillez confirmer votre nouveau mot de passe" name="conf_password" id="conf_password" />
            <span id="alert3"></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Envoyer" id="recup_submit" name="recup_submit">
            <input type="reset" class="btn btn-danger" value="Annuler">
        </div>

</form>

</div>

<?php
include("pieddepage.php");
?>

<!-- Script jQuery -->
<script src="<?php echo base_url("assets/js/recuperation_jquery.js");?>"></script>