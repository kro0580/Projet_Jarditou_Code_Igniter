<?php

// Classe pour connecter un utilisateur

defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Connexion_user extends CI_Model
 {
      public function connexion() 
      {
          $data = $this->input->post(); // On récupère en post toutes les données
          $mail = $this->input->post('mail'); // Puis on récupère le mail
          $requete = $this->db->query("SELECT * FROM users WHERE mail=?", $mail); // Exécution de la requête
          $Connex = $requete->row(); // row() utilisé pour retourner un seul résultat - result() pour retourner plusieurs résultats. Ici on retourne un résultat

          return $Connex; // Appel de la variable qui est un objet contenant toutes les informations
      }
 }
?>