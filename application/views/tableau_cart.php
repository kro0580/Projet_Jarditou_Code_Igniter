<?php
include("entete.php");


?>

<div class="row d-flex justify-content-center">

    <?php

foreach ($liste_produits as $row)  // Pour avoir le nom de la photo dans la BDD

{
    

?>

    <div class="card text-center mb-2 ml-2 border border-primary" style="width: 17rem;">
        <div class="card-header">
            <img src="<?=base_url('assets\images\jarditou_photos/')?><?=$row->pro_photo?>"
                class="card-img-top" alt="Photo produit">
        </div>

        <div class="card-body">

            <h5 class="card-title"><?=$row->pro_libelle?></h5>
            <p class="card-text text-truncate"><?=$row->pro_description?></p>
            <a href="<?=site_url('produits/detail/')?><?= $row->pro_id ?>"
                class="btn btn-primary mr-4">Plus d'informations</a>
        </div>

        <div class="card-footer">
            <?= form_open("produits/ajouterPanier"); ?>
            <p style="margin-top:10px;"> Prix : <?=$row->pro_prix?>€</p>
            <input type="hidden" name="pro_prix" value="<?=$row->pro_prix?>">
            <input type="hidden" name="pro_id" value="<?=$row->pro_id?>">
            <input type="hidden" name="pro_libelle" value="<?=$row->pro_libelle?>">
            <input type="hidden" class="form-control" name="pro_qte" id="pro_qte" value=1>
            <input type="submit" value="Ajouter au panier" class="btn btn-warning">
        </div>

        </form>

    </div>

    <?php

}

?>

</div>

<?php
include("pieddepage.php");
?>