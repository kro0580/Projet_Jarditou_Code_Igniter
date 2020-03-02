<?php

// Classe pour afficher le détail d'un produit

defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Recuperation_mdp extends CI_Model
 {

    public function recuperation() 
      {
          $mail = $this->input->post('mail'); // Puis on récupère le mail
          $requete = $this->db->query("SELECT * FROM users WHERE mail=?", $mail); // Exécution de la requête
          $Connex = $requete->row(); // row() utilisé pour retourner un seul résultat - result() pour retourner plusieurs résultats. Ici on retourne un résultat

          return $Connex; // Appel de la variable qui est un objet contenant toutes les informations
      }

 }
?>