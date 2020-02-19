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
                // $this->form_validation->set_rules('fichier', 'Photo du produit', 'required',
            // array('required' => 'Vous devez insérer une photo'));
                $this->form_validation->set_rules('ajout', 'Date d\'ajout', 'required');  

        $config['upload_path']= 'assets/images/jarditou_photos'; // Destination du téléchargement de l'image
        $config['allowed_types']= 'png|jpg|jpeg'; // Désignation des extensions autorisées
        $config['max_size']= 104857600; // Limite de taille autorisée
        $this->load->library('upload', $config); // Initialisation de la librairie pour le téléchargement de l'image
        if ($this->form_validation->run() == FALSE) // Si la validation ne s'est pas déroulée correctement alors il y a affichage de la vue ajout_produit
        {
            $this->load->model('ajoutprod'); // Chargement de la classe Ajoutprod.php

            $aliste = $this->ajoutprod->categorie(); // Exécution de la fonction categorie()

            $aView['liste_categories'] = $aliste; // Ce qui est entre crochets est une définition de variable qui appelle le $liste_categories qui est dans le fichier ajout_produit.php

            $this->load->view('ajout_produit', $aView); //  Chargement de la vue et de la variable définie à la ligne précédente
        }
        else if (!$this->upload->do_upload('fichier')) // Si le téléchargement de l'image ne s'est pas déroulé correctement alors il y a affichage du message "Erreur"
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

        // $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $row qui est dans le fichier detail.php

        $this->load->view('accueil'); // Chargement de la vue et de la variable définie à la ligne précédente
        
        sleep(2); // Laps de temps de 2 secondes avant le chargement de la vue
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
        $aListe2 = $this->detailprod->categorie(); // Définition d'une variable contenant l'appel de la fonction detail() dans la classe Detailprod

        $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $row qui est dans le fichier detail.php
        $aView["categorie"] = $aListe2; // Ce qui est entre crochets est une définition de variable qui appelle le $categorie qui est dans le fichier detail.php

        $this->load->view('modif_produit', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
    }

// MODIFICATION D'UN PRODUIT

    public function modif($id) // La fonction modif() va nous permettre de modifier le produit quand on clique sur le bouton  valider
    {
    $this->load->database(); // Chargement de la librairie database 
 
    $this->load->helper('url', 'form'); // Chargement des assistants url et form
 
    if ($this->input->post()) 
    {
        $data = $this->input->post(); // On récupère les champs mis en post
 
        $id = $this->input->post("pro_id"); // Tous les name de l'input sont les mêmes que les noms des colonnes de la BDD
 
        $this->db->where('pro_id', $id);
        $this->db->update('produits', $data);
        $this->load->view('modifsuccess');
    } 
    else
    {
        $aListe = $this->db->query("SELECT * FROM produits WHERE id= ?", array($id)); // En cas d'échec on affiche la vue de la page de détail de modification
        $aView["produits"] = $aListe->row(); // Première ligne du résultat
        $this->load->view('modif_produit', $aView);
    }

    }

// AJOUT D'UN CONTACT

    public function ajout_contact()
    {
        $this->load->helper('form', 'url');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nom', 'Votre nom', 'alpha|required',
            array('alpha' => 'Votre nom ne doit contenir que des lettres',
                  'required' => 'Vous devez définir un nom')); // Définition des messages d'erreurs en l'absence de saisie
                $this->form_validation->set_rules('prenom', 'Votre prénom', 'alpha|required',
            array('alpha' => 'Votre prénom ne doit contenir que des lettres',
                  'required' => 'Vous devez définir un prénom'));
                $this->form_validation->set_rules('customRadio', 'Sexe', 'required',
            array('required' => 'Vous devez indiquer votre sexe'));
                $this->form_validation->set_rules('naissance', 'Date de naissance', 'required',
            array('required' => 'Vous devez indiquer une date de naissance'));
                $this->form_validation->set_rules('adresse', 'Adresse', 'required' ,
            array('required' => 'Vous devez indiquer une adresse',));
                $this->form_validation->set_rules('code_postal', 'Code postal', 'integer|exact_length[5]|required',
            array('required' => 'Vous devez indiquer un code postal',
                  'integer' => 'Votre code postal ne doit contenir que des chiffres',
                  'exact_length' => 'Votre code postal doit contenir 5 chiffres'));
                $this->form_validation->set_rules('ville', 'Ville', 'required',
            array('required' => 'Vous devez indiquer une ville',));
                $this->form_validation->set_rules('email', 'Email', 'valid_email',
            array('valid_email' => 'Vous devez saisir une adresse mail valide'));
                $this->form_validation->set_rules('demande', 'Sujet', 'required',
            array('required' => 'Vous devez sélectionner un sujet'));
                $this->form_validation->set_rules('question', 'Votre question', 'required',
            array('required' => 'Vous devez indiquer le sujet de votre question'));
                $this->form_validation->set_rules('accord', 'J\'accepte le traitement informatique de ce formulaire', 'required',
            array('required' => 'Vous devez cocher la case'));

            if ($this->form_validation->run() == FALSE) // Si la validation ne s'est pas déroulée correctement alors il y a affichage de la vue ajout_produit
        {
            $this->load->view('formulaire');
        }
    }

// INSCRIPTION

    public function inscription()
    {
        $this->load->helper('form', 'url');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nom', 'Votre nom', 'alpha|required',
            array('alpha' => 'Votre nom ne doit contenir que des lettres',
                  'required' => 'Vous devez définir un nom')); // Définition des messages d'erreurs en l'absence de saisie
                $this->form_validation->set_rules('prenom', 'Votre prénom', 'alpha|required',
            array('alpha' => 'Votre prénom ne doit contenir que des lettres',
                  'required' => 'Vous devez définir un prénom'));
                $this->form_validation->set_rules('email', 'Email', 'valid_email',
            array('valid_email' => 'Vous devez saisir une adresse mail valide'));
                $this->form_validation->set_rules('identifiant', 'Login', 'required',
            array('required' => 'Vous devez indiquer un login'));
                $this->form_validation->set_rules('password', 'Votre mot de passe', 'regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/]|required',
            array('regex_match' => " Votre mot de passe doit comporter de 8 à 15 caractères, au moins une lettre minuscule, au moins une lettre majuscule, au moins un chiffre, au moins un de ces caractères spéciaux : $ @ % * + - _ !",
                'required' => 'Vous devez indiquer un mot de passe'));
                $this->form_validation->set_rules('conf_password', 'Confirmation de votre mot de passe', 'matches[password]|required',
            array('matches' => 'Vos deux mots de passe sont différents',
                  'required' => 'Vous devez confirmer votre mot de passe'));

            if ($this->form_validation->run() == FALSE) // Si la validation ne s'est pas déroulée correctement alors il y a affichage de la vue ajout_produit
        {
            $this->load->view('inscription');
        }
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