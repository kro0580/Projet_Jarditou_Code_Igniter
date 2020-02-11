<?php

// EXERCICES 1 ET 2

// application/controllers/Produits.php
 
defined('BASEPATH') OR exit('No direct script access allowed'); //  Instruction de sécurité qui empêche l'accès direct au fichier
 
class Produits extends CI_Controller // La classe Produits hérite de la classe CI_Controller
{
 
    public function liste() // La méthode liste va nous permettre d’afficher la liste des produits
    {
        $this->load->model('listeprod'); // On charge le modèle
    
        $aListe = $this->listeprod->liste(); // Définition d'une variable contenant l'appel de la fonction dans la classe Listeprod

        $aView["liste_produits"] = $aListe; // Ce qui est entre crochets est une définition de variable

        $this->load->view('tableau', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
    }

    public function __construct()
    {
        parent:: __construct();
        $this->load->database(); // Appel de la BDD
        $this->load->model('Ajoutprod'); // Appel du modèle où la requête a été définie
    }
    
    public function ajout_produit()
    {
        $this->load->view('ajout_produit'); // Affichage de la vue du formulaire d'ajout
        
    }

    public function insertion_produit()
    {

        $this->load->helper('form', 'url');

                $this->load->library('form_validation');

                $this->form_validation->set_rules('reference', 'Référence', 'required',
            array('required' => 'Vous devez définir une référence'));
                $this->form_validation->set_rules('categorie', 'Catégorie', 'required',
            array('required' => 'Vous devez définir une catégorie'));
                $this->form_validation->set_rules('libelle', 'Libellé', 'required',
            array('required' => 'Vous devez définir un libellé'));
                $this->form_validation->set_rules('description', 'Description', 'required',
            array('required' => 'Vous devez définir une description'));
                $this->form_validation->set_rules('prix', 'Prix', 'required|decimal' ,
            array('required' => 'Vous devez définir un prix',
                  'decimal' => 'Votre prix doit être un nombre décimal'));
                $this->form_validation->set_rules('stock', 'Stock', 'required|integer',
            array('required' => 'Vous devez définir un stock',
                  'integer' => 'Votre stock doit être un chiffre'));
                $this->form_validation->set_rules('couleur', 'Couleur', 'required|alpha',
            array('required' => 'Vous devez définir une couleur',
                  'alpha' => 'Votre couleur ne doit contenir que des lettres'));
                $this->form_validation->set_rules('bloque', 'Produit bloqué', 'required',
            array('required' => 'Vous devez sélectionner une case'));
                $this->form_validation->set_rules('ajout', 'Date d\'ajout', 'required');  

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
        
            $this->load->view('ajout_produit', $aView);

        }
        else
        {
            $fd=$this->upload->data(); // Téléchargement des données

            $fn=$fd['file_name']; // Ajout du nom de l'image dans la BDD

            $this->Ajoutprod->ins($fn); // Insertion du produit grâce à la requête définie dans Ajoutprod

            $this->load->view('ajoutsuccess');
        }
    }

    public function index()
    {
        $this->load->view('accueil');
        
    }

    public function contact()
    {
        $this->load->view('formulaire'); 
        
    }

    public function connexion()
    {
        $this->load->view('connexion'); 
        
    }

    public function detail()
    {
        $this->load->model('detailprod'); // On charge le modèle
    
        $aListe = $this->detailprod->detail(); // Définition d'une variable contenant l'appel de la fonction dans la classe Detailprod

        $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable

        $this->load->view('detail', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
        
    }
}


?>