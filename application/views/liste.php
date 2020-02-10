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
    <td class="text-center align-middle"><a href="detail.php?pro_id=<?= $row->pro_id ?>" title="libelle" id="link_dark" style= "color: #4169FE; text-decoration: underline" ><?= $row->pro_libelle ?></td>
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

    <!-- JavaScript et jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Bootstrap select -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
    
</body>

</html>

<?php
include("pieddepage.php");
?>