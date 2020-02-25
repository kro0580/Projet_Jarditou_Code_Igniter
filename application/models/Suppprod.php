<?php

// Classe pour supprimer un produit

defined('BASEPATH') OR exit('No direct script access allowed');

class Suppprod extends CI_Model // Définition des données à récuperer et à renvoyer dans la BDD
{
    public function suppr($pro_id)
    {
          $this->db->delete('produits', array('pro_id'=>$pro_id)); // Requête pour supprimer le produit
    }
}
?>