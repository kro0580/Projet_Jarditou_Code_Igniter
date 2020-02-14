<?php
 
defined('BASEPATH') OR exit('No direct script access allowed'); //  Instruction de sécurité qui empêche l'accès direct au fichier
 
class Produits extends CI_Controller // La classe Produits hérite de la classe CI_Controller
{
// VUE DE LA LISTE DE PRODUIT AU CLIC DU LIEN "TABLEAU" DANS LA BARRE DE NAVIGATION

    public function liste() // La fonction liste va nous permettre d’afficher la liste des produits quand on clique sur le lien tableau dans l'en-tête
    {
        $this->load->model('listeprod'); // On charge le modèle Listeprod.php
    
        $aListe = $this->listeprod->liste(); // Définition d'une variable contenant l'appel de la fonction list() dans la classe Listeprod

        $aView["liste_produits"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $liste_produits qui est dans le fichier tableau.php

        $this->load->view('tableau', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
    }
    
// INSERTION D'UN PRODUIT ET TELECHARGERMENT DE L'IMAGE

    public function __construct()
    {
        parent:: __construct(); 
        
        $this->load->database(); // Appel de la BDD

        $this->load->model('ajoutprod'); // Appel du modèle où la requête a été définie
    }

// VUE DE LA PAGE AJOUTER UN PRODUIT AU CLIC DU LIEN "AJOUTER UN PRODUIT" DANS LA BARRE DE NAVIGATION

    public function ajout_produit() // La fonction ajout_produit va nous permettre d'afficher les catégories de produit dans la vue ajout_produit
    {
        $this->load->model('ajoutprod'); // Chargement de la classe Ajoutprod.php

        $aliste = $this->ajoutprod->categorie(); // Exécution de la fonction categorie()

        $aView['liste_categories'] = $aliste; // Ce qui est entre crochets est une définition de variable qui appelle le $liste_categories qui est dans le fichier ajout_produit.php

        $this->load->view('ajout_produit', $aView); //  Chargement de la vue et de la variable définie à la ligne précédente  
    }

    public function insertion_produit() // La fonction insertion_produit() va nous permettre d'ajouter un produit quand on clique sur le bouton ajouter, cela envoie au form_open qui appelle la fonction insertion-produit()
    {

        $this->load->helper('form', 'url');

                $this->load->library('form_validation');

                $this->form_validation->set_rules('reference', 'Référence', 'required',
            array('required' => 'Vous devez définir une référence')); // Définition des messages d'erreurs en l'absence de saisie
                $this->form_validation->set_rules('categorie', 'Catégorie', 'required',
            array('required' => 'Vous devez définir une catégorie'));
                $this->form_validation->set_rules('libelle', 'Libellé', 'required',
            array('required' => 'Vous devez définir un libellé'));
                $this->form_validation->set_rules('description', 'Description', 'required',
            array('required' => 'Vous devez définir une description'));
                $this->form_validation->set_rules('prix', 'Prix', 'required|numeric' ,
            array('required' => 'Vous devez définir un prix',
                  'numeric' => 'Votre prix doit être un nombre décimal'));
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
        if ($this->form_validation->run() == FALSE) // Si la validation ne s'est pas déroulée correctement alors il y a affichage de la vue ajout_produit
        {
            $this->load->view('ajout_produit');
        }

        else if (!$this->upload->do_upload('fichier')) // Si le téléchargement de l'image ne s'est pas déroulée correctement alors il y a affichage du message "Erreur"
        {
            echo "Erreur";

        }
        else // Sinon 
        {
            $fd=$this->upload->data(); // Téléchargement des données

            $fn=$fd['file_name']; // Ajout du nom de l'image dans la BDD

            $this->ajoutprod->ins($fn); // Insertion du produit grâce à la requête définie dans Ajoutprod

            $this->load->view('ajoutsuccess'); // Affichage du pop_up "Good Job"
        }
    }

// DETAIL D'UN PRODUIT

    public function detail() // La fonction detail() va nous permettre d'afficher le détail un produit quand on clique sur le lien dans le fichier tableau.php
    {
        $this->load->model('detailprod'); // On charge la classe Detailprod.php
    
        $aListe = $this->detailprod->detail(); // Définition d'une variable contenant l'appel de la fonction detail() dans la classe Detailprod

        $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $row qui est dans le fichier detail.php

        $this->load->view('detail', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
        
    }

// SUPPRESSION D'UN PRODUIT

    public function suppr() // La fonction suppr() va nous permettre de supprimer un produit quand on clique sur le bouton supprimer dans la page detail.php
    {
        $this->load->model('suppprod'); // On charge la classe Suppprod.php

        $aListe = $this->suppprod->suppr(); // Définition d'une variable contenant l'appel de la fonction suppr() dans la classe Suppprod

        $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $row qui est dans le fichier detail.php

        $this->load->view('accueil', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
    }

// SUCCES DE LA SUPPRESSION D'UN PRODUIT

    public function suppr_success() // La fonction suppr_success() va nous permettre d'afficher une page de confirmation de suppression du produit sélectionné. Cette fonction est appellé dans le onclick sur le bouton supprimer dans le fichier detail.php
    {
        $this->load->view('supprsuccess'); // Chargement de la vue
    }

// DETAIL POUR LA MODIFICATION D'UN PRODUIT

    public function detail_modif() // La fonction detail_modif() va nous permettre d'afficher le détail du produit à modifier quand on clique sur le bouton modifier dans le fichier detail.php 
    {
        $this->load->model('detailprod'); // On charge la classe Detailprod.php

        $aListe = $this->detailprod->detail(); // Définition d'une variable contenant l'appel de la fonction detail() dans la classe Detailprod

        $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $row qui est dans le fichier detail.php

        $this->load->view('modif_produit', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
    }

// MODIFICATION D'UN PRODUIT

    public function modif()
    {
        $this->load->model('modifprod');

        $aListe = $this->modifprod->modif();

        $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable

        $this->load->view('detail', $aView);

    }

// VUE DE LA PAGE ACCUEIL AU CLIC DU LIEN "ACCUEIL" DANS LA BARRE DE NAVIGATION

    public function index()
    {
        $this->load->view('accueil');
        
    }

// VUE DE LA PAGE CONTACT AU CLIC DU LIEN "CONTACT" DANS LA BARRE DE NAVIGATION

    public function contact()
    {
        $this->load->view('formulaire'); 
        
    }

// VUE DE LA PAGE DE CONNEXION AU CLIC DU LIEN "CONNEXION" DANS LA BARRE DE NAVIGATION

    public function connexion()
    {
        $this->load->view('connexion'); 
        
    }
}


?>