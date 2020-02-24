<?php

// Classe pour modifier un produit

defined('BASEPATH') OR exit('No direct script access allowed');

class Modifprod extends CI_Model // Définition des données à récuperer et à renvoyer dans la BDD
{
    public function modif($pro_id)
    {
      $this->load->database(); // Pour charger la BDD
      $data = $this->input->post(); // On récupère les champs mis en post
 
      $id = $this->input->post("pro_id"); // Tous les name de l'input sont les mêmes que les noms des colonnes de la BDD

      $this->db->where('pro_id', $pro_id);
      $this->db->update('produits', $data);
    }
}
?>