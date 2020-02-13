<?php

// Classe pour modifier un produit

defined('BASEPATH') OR exit('No direct script access allowed');

class Modifprod extends CI_Model // Définition des données à récuperer et à renvoyer dans la BDD
{
    public function modif()
    {
          $pro_id = $_GET["pro_id"]; // Pour récupérer l'ID du produit
          $this->load->database(); // Pour charger la BDD
          $data = array(
            'pro_ref' => 'reference',
            'pro_cat_id'  => 'categorie',
            'pro_libelle'  => 'libelle',
            'pro_description'  => 'description',
            'pro_prix'  => 'prix',
            'pro_stock'  => 'stock',
            'pro_couleur'  => 'couleur',
            'pro_bloque'  => 'bloque'
    );
          $this->db->where('pro_id', $pro_id);
          $this->db->update('produits');
    }
}
?>