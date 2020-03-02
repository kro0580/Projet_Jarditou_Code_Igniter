<?php

include ("entete.php");

?>

<div class="row">
    <b>
        <p style="font-size: 35px;">Mon panier</p>
    </b>
</div>

<?php 
// Si le panier n'existe pas encore
if ($this->session->panier != null) 
{ 
?>

<div class="row">

    <table class="table table-striped">

        <thead style="text-align: center">
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Prix total</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <?php 
        $iTotal = 0;
        $aPanier = $this->session->panier;
 
       foreach($aPanier as $article)
       {
if($article["pro_qte"] !=0)
{



?>
            <tr>
                <td style="text-align: center"><?=$article["pro_libelle"]?></td>
                <td style="text-align: center"><?=$article["pro_prix"]?> &euro;</td>
                <td style="text-align: center"><input type="number" min="0" onchange="modifQuant(value, <?=$article['pro_id']?>)" value="<?=$article['pro_qte']?>"></td>
                <td style="text-align: center"><?=number_format(($article["pro_qte"]*$article["pro_prix"]),2)?> &euro;
                </td>
                <td style="text-align: center">&nbsp;</td>
            </tr>
            <?php

}

else
{
    redirect("produits/supprimerProduit/".$article['pro_id']);
}

    $iTotal += $article["pro_qte"]*$article["pro_prix"];

       }
?>
        </tbody>
    </table>

    <div>
        <b>
            <p style="font-size: 25px;">Récapitulatif</p>
        </b>

        <p>TOTAL : <?= str_replace('.', ',' , $iTotal); ?> &euro;</p>
        <a class="btn btn-danger" style="color: white; margin-left: auto;"
            href="<?= site_url("produits/supprimerPanier"); ?>">Supprimer le panier</a>
        <a class="btn btn-warning" style="color: white; margin-left: auto;"
            href="<?= site_url("produits/liste"); ?>">Retour à la liste des produits</a>
    </div>

</div>

<?php 
} 
else 
{ 
 
?>

<div class="row alert alert-danger">Votre panier est vide. Pour le remplir, vous pouvez consulter <a
        style="color: blue; margin-left: 3px;" href="<?= site_url("produits/liste"); ?>">la liste des produits.</a>
</div>

<?php 
    } 
  ?>

<?php

include ("pieddepage.php");

?>

<script>
    function modifQuant(value, id) {
        if(value == "")
        {
            value = 0;
        }
        window.location.replace("http://localhost/Jarditou_CI/index.php/produits/modifierQuantite/" + id + "/" + value);

    }
</script>