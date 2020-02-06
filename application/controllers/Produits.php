<?php

// EXERCICES 1 ET 2

// application/controllers/Produits.php
 
defined('BASEPATH') OR exit('No direct script access allowed'); //  Instruction de sécurité qui empêche l'accès direct au fichier
 
class Produits extends CI_Controller // La classe Produits hérite de la classe CI_Controller
{
 
    public function liste() // La méthode liste va nous permettre d’afficher la liste des produits
    {
        // Charge la librairie 'database'
        $this->load->database(); // Charge la librairie database et se connecte à la base de données (création d'un objet db)
    
        // Exécute la requête 
        $results = $this->db->query("SELECT * FROM produits"); // Exécute la requête, 
    
        // Récupération des résultats    
        $aListe = $results->result();   
    
        // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue   
        $aView["liste_produits"] = $aListe; // Charge le résultat de la requête dans la variable $aView["liste"]
    
        // Appel de la vue avec transmission du tableau  
        $this->load->view('liste', $aView); // Appelle la vue liste.php et lui transmet le tableau $aView. La vue liste.php se trouve dans le répertoire application/views/liste
    }

}