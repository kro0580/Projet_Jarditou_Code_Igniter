<?php
include("entete.php");

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d H:i:s"); // Format de date avec codeigniter

echo validation_errors('<div class="alert alert-danger">','</div>');

?>

<div class="row">

    <?php echo form_open_multipart("produits/insertion_produit", array('class' => 'col-lg-12')); ?>

    <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" class="form-control" name="reference" id="reference"
            value="<?php echo set_value('pro_ref')?>"> <!-- Le name et l'id doivent être identiques -->
        <span id="alert12"></span>
    </div>

    <div class="form-group">
        <label for="categorie">Catégorie</label>
        <select class="custom-select" name="categorie" id="categorie">
            <option value="">-- Veuillez sélectionner une catégorie --</option>
            <?php
    foreach($liste_categories as $row) // Permet l'affichage du menu déroulant pour obtenir la liste des catégories
    {
        ?>
            <option value="<?= $row->cat_id?>"> <?=$row->cat_id."-".$row->cat_nom?></option>
            <?php
    }
    ?>
        </select>
        <span id="alert13"></span>
    </div>

    <div class="form-group">
        <label for="libelle">Libellé</label>
        <input type="text" class="form-control" name="libelle" id="libelle"
            value="<?php echo set_value('pro_libelle')?>">
        <span id="alert14"></span>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description"
            id="description"><?php echo set_value('pro_description')?></textarea>
        <!-- Pour les textarea on doit afficher la valeur entre les balises et non pas dans une value comme pour les inputs -->
        <span id="alert15"></span>
    </div>

    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" id="prix" value="<?php echo set_value('pro_prix')?>">
        <span id="alert16"></span>
    </div>

    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="text" class="form-control" name="stock" id="stock" value="<?php echo set_value('pro_stock')?>">
        <span id="alert17"></span>
    </div>

    <div class="form-group">
        <label for="couleur">Couleur</label>
        <input type="text" class="form-control" name="couleur" id="couleur"
            value="<?php echo set_value('pro_couleur')?>">
        <span id="alert18"></span>
    </div>

    <p>Produit bloqué</p>

    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" id="pro_bloque_oui" name="bloque" value=1>
        <!-- On récupère la valeur 1 quand le produit est bloqué -->
        <label class="form-check-label" for="bloque">Oui</label>
    </div>

    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" id="pro_bloque_non" name="bloque" value=0>
        <!-- On récupère la valeur 0 quand le produit n'est pas bloqué -->
        <label class="form-check-label" for="bloque">Non</label>
    </div></br></br>

    <span id="alert19"></span>

    <!-- TELECHARGEMENT IMAGE -->

    <div class="form-group">
        <label for="photo">Photo du produit</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
        <p><input type="file" name="fichier" id="fichier"></p>
    </div>

    <div class="form-group">
        <label for="ajout">Date d'ajout</label>
        <input type="text" class="form-control" id="ajout" name="ajout" value="<?=$date?>" readonly>
        <!-- On récupère la date du jour : value ="<?=$date?> que l'on met en readonly pour empêcher toute modification -->
    </div>

    <div class="form-group">
        <!-- Quand on clique sur le bouton retour on affiche le tableau -->
        <a href="<?=site_url('produits/liste')?>" class="btn btn-dark m-0">Retour</a>
        <input type="submit" class="btn btn-success" value="Ajouter" id="bouton_envoi2">
        <input type="reset" class="btn btn-danger" value="Annuler">
    </div>

    </form>

</div>

<?php
include("pieddepage.php");
?>

<!-- Script jQuery -->
<script src="jquery\ajout_script.js"></script>