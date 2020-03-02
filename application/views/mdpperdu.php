<?php
include("entete.php");

echo validation_errors('<div class="alert alert-danger">','</div>');

?>

<?php echo form_open("produits/mdp_perdu"); ?>

<h4>Récupération du mot de passe</h4>

<div class="form-group"></br>

        <div class="form-group">
            <label for="email">Votre Email<b>*</b></label>
            <input type="email" class="form-control" placeholder="Veuillez indiquer votre adresse mail" name="email" id="email" />
            <span id="alert1"></span>
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