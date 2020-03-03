<?php
include("entete.php");

echo validation_errors('<div class="alert alert-danger">','</div>');
?>


<div class="container">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card bg-dark mt-5 mb-5">
                <div class="card-title bg-primary text-white mt-5">
                    <h3 class="text-center py-3">Connexion</h3>
                </div>

                <div class="card-body">

                    <?php echo form_open("produits/connexion", array('class' => 'col-lg-12')); ?>

                    <input type="text" id="mail" name="mail" placeholder="Email" class="form-control mb-3">
                    <span id="alert1"></span>
                    <input type="password" id="password" name="password" placeholder="Mot de passe"
                        class="form-control mb-3">
                    <span id="alert2"></span>
                    <p style="color: white; font-size: 14px">Mot de passe perdu ?<a
                            href="<?=site_url('produits/mdp_perdu')?>">Cliquez ici</a></p>
                    <button class="btn btn-success mt-3" name="login" id="bouton_envoi2">Se connecter</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<h5 class="text-center">Vous n'avez pas de compte ?</h5>
<h5 class="text-center"><a href="<?=site_url('produits/inscription')?>"
        style="color: #4169FE; text-decoration: underline">Inscrivez-vous</a></h5></br>



<?php
include("pieddepage.php");
?>

<!-- Script jQuery -->
<script src="<?php echo base_url("assets/js/connexion_jquery.js");?>"></script>