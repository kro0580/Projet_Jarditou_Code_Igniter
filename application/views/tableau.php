<?php
include("entete.php");
?>

<div class= "row"> <!-- Pour que le tableau soit bien aligné avec la bannière -->

<div class="table-responsive"> <!-- Pour que le tableau soit en responsive -->


<!-- Bordure de tous les côtés de la table et des cellules et ajout de zébrures sur une ligne sur deux du tableau -->
<table class="table table-bordered table-striped">
            <thead align="center">
                    <tr>
                        <th>Photos</th>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Libellé</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Couleur</th>
                        <th>Ajout</th>
                        <th>Modif</th>
                        <th>Bloqué</th>
                    </tr>
            </thead>
<?php



foreach ($liste_produits as $row)  // Pour avoir le nom de la photo dans la BDD
{

?>

    <tr>
    <td><img src ="http://localhost/Jarditou_ci/assets\images\jarditou_photos/<?=$row->pro_photo?>" width= "100" height= "auto" class="text-center align-middle"></td>
    <td class="text-center align-middle"><?= $row->pro_id ?> </td>
    <td class="text-center align-middle"><?= $row->pro_ref ?></td>
    <td class="text-center align-middle"><a href="http://localhost/Jarditou_ci/index.php/produits/detail?pro_id=<?= $row->pro_id ?>" title="libelle" id="link_dark" style= "color: #4169FE; text-decoration: underline" ><?= $row->pro_libelle ?></td>
    <td class="text-center align-middle"><?= $row->pro_prix ?> €</td>
    <td class="text-center align-middle"><?= $row->pro_stock ?> </td>
    <td class="text-center align-middle"><?= $row->pro_couleur ?> </td>
    <td class="text-center align-middle"><?= $row->pro_d_ajout  ?></td>
    <td class="text-center align-middle"><?= $row->pro_d_modif ?> </td>
    <td class="text-center align-middle"><?= $row->pro_bloque ?> </td>
    </tr>

<?php
}
?>
 
</table>

</div>
</div>

</body>

</html>

<?php
include("pieddepage.php");
?>