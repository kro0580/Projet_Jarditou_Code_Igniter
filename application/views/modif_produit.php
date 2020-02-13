<?php 

include("entete.php"); // Inclusion de l'en-tête construite dans le fichier entete.php

$query=$this->db->query("SELECT * FROM categories ORDER BY cat_id");

?>

<div class="row">

<form class="col-lg-12">

<div class="text-center">

<img src="http://localhost/Jarditou_ci/assets\images\jarditou_photos\<?=$row->pro_photo?>" width="300" alt="produit"> <!-- Pour ajouter la photo du produit : width="300 permet de redimensionner la photo et en n'indiquant qu'un seul paramètre le navigateur se charge de calculer le deuxième c'est à dire height en conservant les proportions de départ -->
</div>

<div class="form-group">
    <label for="référence">Référence :</label>
    <input type="text" class="form-control" name="reference" value ="<?=$row->pro_ref?>" id="reference"> <!-- Dans value, on récupère la valeur de la référence et readonly pour avoir en lecture seule -->  
</div>

<div class="form-group">
    <label for="categorie">Catégorie :</label>
    <select class="custom-select" name="categorie" id="categorie">
    <option value="">-- Veuillez sélectionner une catégorie --</option> 
    <?php
    foreach($query->result() as $row2) // Permet l'affichage du menu déroulant pour obtenir la liste des catégories
    {
        ?>
        <option value = "<?= $row2->cat_id?>"
        <?php

        if ($row2->cat_id == $row->pro_cat_id)
        {
            echo "selected";
        }
        ?>
        >
        <?=$row2->cat_id."-".$row2->cat_nom?></option>
        
        <?php
    }
    ?>
    </select>
</div>

<div class="form-group">
    <label for="libellé">Libellé :</label>   
    <input type="text" class="form-control" name="libelle" value ="<?=$row->pro_libelle?>" id="libelle">  
</div>

<div class="form-group">
    <label for="description">Description :</label>
    <textarea class="form-control" name="description" value placeholder ="<?=$row->pro_description?>" id="description"></textarea>
</div>

<div class="form-group">
    <label for="prix">Prix :</label>  
    <input type="text" class="form-control" name="prix" value ="<?=$row->pro_prix?>" id="prix">       
</div>

<div class="form-group">
    <label for="stock">Stock :</label>
    <input type="text" class="form-control" name="stock" value ="<?=$row->pro_stock?>" id="stock"> 
</div>

<div class="form-group">
    <label for="couleur">Couleur :</label> 
    <input type="text" class="form-control" name="couleur" value ="<?=$row->pro_couleur?>" id="couleur">  
</div>


<p>Produit bloqué ? :</p>

<div class="form-check form-check-inline">
  <input type="radio" class="form-check-input" value ="<?=$row->pro_bloque?>" id="bloque_oui" name="bloque" disabled <?php if ($row->pro_bloque == 1) { echo "checked"; } ?>> <!-- disabled pour avoir en lecture seule et on indique une condition si la valeur récupérée est 1 alors on coche -->
  <label class="form-check-label" for="bloque">Oui</label>
</div>

<div class="form-check form-check-inline">
  <input type="radio" class="form-check-input" value ="<?=$row->pro_bloque?>" id="bloque_non" name="bloque" disabled <?php if (is_null($row->pro_bloque)) { echo "checked"; } ?>>
  <label class="form-check-label" for="bloque">Non</label>
</div>

</div><br>

<div class="form-group">
    <label for="ajout">Date d'ajout :</label> 
    <input type="text" class="form-control" name="ajout" value ="<?=$row->pro_d_ajout?>" id="ajout" readonly> 
</div>

<div class="form-group">
    <label for="modif">Date de modification :</label> 
    <input type="text" class="form-control" name="modif" value ="<?=$row->pro_d_modif?>" id="modif" readonly>
</div>

<div class="form-group">
    <!-- Quand on clique sur le bouton retour on affiche le tableau -->
    <a href="http://localhost/Jarditou_ci/index.php/produits/liste" class="btn btn-dark m-0">Retour</a>
    <!-- Quand on clique sur le bouton modifier on exécute le script du fichier sur lequel on fait un lien et on récupère l'ID avec ?pro_id=<?= $produit->pro_id?> -->
    <a href="http://localhost/Jarditou_ci/index.php/produits/modif?pro_id=<?= $row->pro_id?>" class="btn btn-success m-0">Valider</a>
    
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