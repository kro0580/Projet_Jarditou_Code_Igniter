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

    public function __construct()
    {
        parent:: __construct();
        $this->load->helper('url'); // Appel de la fonction base_url() désignée dans le form du fichier addp.php et définie dans l'autoload
        $this->load->database(); // Appel de la BDD
        $this->load->model('Productmod'); // Appel du modèle où la requête a été définie
    }
    
    
    public function addproduct()
    {
        $this->load->view('addp'); // Affichage de la vue du formulaire d'ajout
        
    }

    public function insert()
    {

        $this->load->helper('form', 'url');

                $this->load->library('form_validation');

                $this->form_validation->set_rules('reference', 'Référence', 'required');
                $this->form_validation->set_rules('categorie', 'Catégorie', 'required');
                $this->form_validation->set_rules('libelle', 'Libellé', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                $this->form_validation->set_rules('prix', 'Prix', 'required');
                $this->form_validation->set_rules('stock', 'Stock', 'required');
                $this->form_validation->set_rules('couleur', 'Couleur', 'required');
                $this->form_validation->set_rules('bloque', 'Produit bloqué', 'required');
                $this->form_validation->set_rules('ajout', 'Date d\'ajout', 'required');

                if ($this->form_validation->run() == TRUE)
                {
                    echo "Formulaire validé";
                }

        $config['upload_path']= 'assets/images/jarditou_photos'; // Destination du téléchargement de l'image
        $config['allowed_types']= 'png|jpg|jpeg'; // Désignation des extensions autorisées
        $config['max_size']= 104857600; // Limite de taille autorisée
        $this->load->library('upload', $config); // Initialisation de la librairie pour le téléchargement de l'image
            if ( ! $this->upload->do_upload('fichier')) 
        {
            // Echec : on récupère les erreurs dans une variable (une chaîne)
            $errors = $this->upload->display_errors();    
        
            // on réaffiche la vue du formulaire en passant les erreurs 
            $aView["errors"] = $errors;
        
            $this->load->view('addp', $aView);

        }
        else
        {
            $fd=$this->upload->data(); // Téléchargement des données

            $fn=$fd['file_name']; // Ajout du nom de l'image dans la BDD

            $this->Productmod->ins($fn); // Insertion de l'image grâce à la requête définie dans Productmod

            header("Location: http://localhost/Jarditou_ci/"); // Redirection vers le tableau des produits
        }
    }
}


?>