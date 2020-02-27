<?php 

include("entete.php"); // Inclusion de l'en-tête construite dans le fichier entete.php

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d H:i:s"); // Format de date avec codeigniter

?>

<div class="row">

    <?php echo form_open_multipart("produits/modif/$row->pro_id",  array('class' => 'col-12')); ?>

    <div class="text-center">

        <img src="http://localhost/Jarditou_ci/assets\images\jarditou_photos\<?=$row->pro_photo?>" width="300"
            alt="produit">
        <!-- Pour ajouter la photo du produit : width="300 permet de redimensionner la photo et en n'indiquant qu'un seul paramètre le navigateur se charge de calculer le deuxième c'est à dire height en conservant les proportions de départ -->
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" name="pro_id" value="<?=$row->pro_id?>" id="pro_id" readonly>
        <!-- Dans value, on récupère la valeur de la référence et readonly pour avoir en lecture seule -->
    </div>

    <div class="form-group">
        <label for="référence">Référence :</label>
        <input type="text" class="form-control" name="pro_ref" value="<?=$row->pro_ref?>" id="reference">
        <!-- Dans value, on récupère la valeur de la référence et readonly pour avoir en lecture seule -->
    </div>

    <div class="form-group">
        <label for="categorie">Catégorie :</label>
        <select class="custom-select" name="pro_cat_id" id="categorie">
            <option value="">-- Veuillez sélectionner une catégorie --</option>
            <?php
    foreach($categorie as $row2) // Permet l'affichage du menu déroulant pour obtenir la liste des catégories
    {
        ?>
            <option value="<?= $row2->cat_id?>" <?php

        if ($row2->cat_id == $row->pro_cat_id)
        {
            echo "selected";
        }
        ?>>
                <?=$row2->cat_id."-".$row2->cat_nom?></option>

            <?php
    }
    ?>
        </select>
    </div>

    <div class="form-group">
        <label for="libellé">Libellé :</label>
        <input type="text" class="form-control" name="pro_libelle" value="<?=$row->pro_libelle?>" id="libelle">
    </div>

    <div class="form-group">
        <label for="description">Description :</label>
        <textarea class="form-control" name="pro_description" id="description"><?=$row->pro_description?></textarea>
    </div>

    <div class="form-group">
        <label for="prix">Prix :</label>
        <input type="text" class="form-control" name="pro_prix" value="<?=$row->pro_prix?>" id="prix">
    </div>

    <div class="form-group">
        <label for="stock">Stock :</label>
        <input type="text" class="form-control" name="pro_stock" value="<?=$row->pro_stock?>" id="stock">
    </div>

    <div class="form-group">
        <label for="couleur">Couleur :</label>
        <input type="text" class="form-control" name="pro_couleur" value="<?=$row->pro_couleur?>" id="couleur">
    </div>


    <p>Produit bloqué ? :</p>

    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" value="<?=$row->pro_bloque?>" id="bloque_oui" name="pro_bloque"
            disabled <?php if ($row->pro_bloque == 1) { echo "checked"; } ?>>
        <!-- disabled pour avoir en lecture seule et on indique une condition si la valeur récupérée est 1 alors on coche -->
        <label class="form-check-label" for="bloque">Oui</label>
    </div>

    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" value="<?=$row->pro_bloque?>" id="bloque_non" name="pro_bloque"
            disabled <?php if ($row->pro_bloque == 0) { echo "checked"; } ?>>
        <label class="form-check-label" for="bloque">Non</label>
    </div>

</div><br>

<p>Photo du produit :</p>

<!-- <input type="hidden" name="MAX_FILE_SIZE" value="104857600" /> -->

<p><input type="file" name="fichier" id="fichier"></p>

<div class="form-group">
    <label for="ajout">Date d'ajout :</label>
    <input type="text" class="form-control" name="pro_d_ajout" value="<?=$row->pro_d_ajout?>" id="ajout" readonly>
</div>

<div class="form-group">
    <label for="modif">Date de modification :</label>
    <input type="text" class="form-control" name="pro_d_modif" value="<?=$date?>" id="modif" readonly>
</div>

<div class="form-group">
    <!-- Quand on clique sur le bouton retour on affiche le tableau -->
    <a href="http://localhost/Jarditou_ci/index.php/produits/liste" class="btn btn-dark m-0">Retour</a>
    <!-- Quand on clique sur le bouton modifier on exécute le script du fichier sur lequel on fait un lien et on récupère l'ID avec ?pro_id=<?= $produit->pro_id?> -->
    <input type="submit" value="Valider" class="btn btn-success m-0">

    <?php
    if(isset($_SESSION["Admin"]))
        {
        ?>

    <?php
        }
    ?>
</div>

</form>

<?php
include("pieddepage.php"); // Inclusion du pied de page
?>