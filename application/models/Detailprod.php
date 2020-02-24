<?php

// Classe pour afficher le détail d'un produit

defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Detailprod extends CI_Model
 {
      public function detail($pro_id) 
      {
          $this->load->database(); // Pour charger la BDD
          $requete = $this->db->query("SELECT * FROM produits INNER JOIN categories ON categories.cat_id = produits.pro_cat_id WHERE pro_id=?",$pro_id); // Initialisation de la requête
          $aProduits = $requete->row(); // row() utilisé pour retourner un seul résultat - result() pour retourner plusieurs résultats. Ici on retourne le détail d'un seul produit à la fois

          return $aProduits; // Appel de la variable
      }

      public function categorie()
      {
        $this->load->database();

        $requete = $this->db->get('categories'); // Requête pour afficher les catégories
        
        if($requete->num_rows() > 0) // Si la liste contient au moins une ligne, on affiche le résultat
        {
            $results = $requete->result();
        }

        else // Sinon o affiche un message d'erreur
        {
            echo "Aucune catégorie de produits";
        }

        return $results;
      }
 }
?>