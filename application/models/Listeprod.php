<?php

// Classe pour afficher la liste des produits

defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Listeprod extends CI_Model
 {
      public function liste() 
      {
          $this->load->database(); // Pour charger la BDD
          $requete = $this->db->query("SELECT * FROM produits");
          $aListe = $requete->result(); // row() utilisé pour retourner un seul résultat - result() pour retourner plusieurs résultats

          return $aListe; // Appel de la variable
      }
 }
?>