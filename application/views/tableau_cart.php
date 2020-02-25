<?php
include("entete.php");

echo form_open("produits/ajoutePanier");
?>

<div class= "row d-flex justify-content-center">

<?php

foreach ($liste_produits as $row)  // Pour avoir le nom de la photo dans la BDD

{

?>

<div class="card text-center mb-2 ml-2 border border-primary" style="width: 17rem;">
    <div class="card-header">
    <img src ="http://localhost/Jarditou_ci/assets\images\jarditou_photos/<?=$row->pro_photo?>" class="card-img-top" alt="Photo produit">
    </div>

    <div class="card-body">
    <h5 class="card-title"><?=$row->pro_libelle?></h5>
    <p class="card-text text-truncate"><?=$row->pro_description?></p>
    <a href="http://localhost/Jarditou_ci/index.php/produits/detail/<?= $row->pro_id ?>" class="btn btn-primary mr-4">Plus d'informations</a>
    </div>

    <div class="card-footer">
    <p style="margin-top:10px;"> Prix : <?=$row->pro_prix?>€</p>
    <input type="hidden" name="pro_prix" value="<?=$row->pro_prix ?>">
    <input type="hidden" name="pro_id" value="<?=$row->pro_id ?>">
    <input type="hidden" name="pro_libelle" value="<?=$row->pro_libelle ?>">
    <a href="<?=base_url("index.php/produits/ajout_panier/".$row->pro_id);?>" class="btn btn-warning mr-4">Ajouter au panier</a>
    <p style="margin-top:15px;">Quantité en stock : <?=$row->pro_stock?></p>
    </div>

    
</div>

<?php

}

?>

</div>

<?php
include("pieddepage.php");
?>