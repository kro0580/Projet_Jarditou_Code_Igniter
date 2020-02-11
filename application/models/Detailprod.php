<?php

// Classe pour afficher le détail d'un produit

defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Detailprod extends CI_Model
 {
      public function detail() 
      {
          $pro_id = $_GET["pro_id"]; // Pour récupérer l'ID du produit
          $this->load->database(); // Pour charger la BDD
          $requete = $this->db->query("SELECT * FROM produits INNER JOIN categories ON categories.cat_id = produits.pro_cat_id WHERE pro_id=".$pro_id); // Initialisation de la requête
          $aProduits = $requete->row(); // row() utilisé pour retourner un seul résultat - result() pour retourner plusieurs résultats

          return $aProduits; // Appel de la variable
      }
 }
?>