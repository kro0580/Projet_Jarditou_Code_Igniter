<?php
 
defined('BASEPATH') OR exit('No direct script access allowed'); //  Instruction de sécurité qui empêche l'accès direct au fichier
 
class Produits extends CI_Controller // La classe Produits hérite de la classe CI_Controller
{
// VUE DE LA LISTE DE PRODUIT AU CLIC DU LIEN "TABLEAU" DANS LA BARRE DE NAVIGATION

    public function liste() // La fonction liste va nous permettre d’afficher la liste des produits quand on clique sur le lien tableau dans l'en-tête
    {
        $this->load->model('listeprod'); // On charge le modèle Listeprod.php
    
        $aListe = $this->listeprod->liste(); // Définition d'une variable contenant l'appel de la fonction liste() dans la classe Listeprod

        $aView["liste_produits"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $liste_produits qui est dans le fichier tableau.php

        $this->load->view('tableau_cart', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
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

    public function detail($pro_id) // La fonction detail() va nous permettre d'afficher le détail un produit quand on clique sur le lien dans le fichier tableau.php
    {
        $this->load->model('detailprod'); // On charge la classe Detailprod.php
    
        $aListe = $this->detailprod->detail($pro_id); // Définition d'une variable contenant l'appel de la fonction detail() dans la classe Detailprod

        $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $row qui est dans le fichier detail.php

        $this->load->view('detail', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
        
    }

// SUPPRESSION D'UN PRODUIT

    public function suppr($pro_id) // La fonction suppr() va nous permettre de supprimer un produit quand on clique sur le bouton supprimer dans la page detail.php
    {
        $this->load->model('suppprod'); // On charge la classe Suppprod.php

        $this->suppprod->suppr($pro_id); // Définition d'une variable contenant l'appel de la fonction suppr() dans la classe Suppprod

        $this->load->view('accueil'); // Chargement de la vue et de la variable définie à la ligne précédente
        
        sleep(2); // Laps de temps de 2 secondes avant le chargement de la vue
    }

// SUCCES DE LA SUPPRESSION D'UN PRODUIT

    public function suppr_success() // La fonction suppr_success() va nous permettre d'afficher une page de confirmation de suppression du produit sélectionné. Cette fonction est appellé dans le onclick sur le bouton supprimer dans le fichier detail.php
    {
        $this->load->view('supprsuccess'); // Chargement de la vue
    }

// DETAIL POUR LA MODIFICATION D'UN PRODUIT

    public function detail_modif($pro_id) // La fonction detail_modif() va nous permettre d'afficher le détail du produit à modifier quand on clique sur le bouton modifier dans le fichier detail.php 
    {
        $this->load->model('detailprod'); // On charge la classe Detailprod.php

        $aListe = $this->detailprod->detail($pro_id); // Définition d'une variable contenant l'appel de la fonction detail() dans la classe Detailprod
        $aListe2 = $this->detailprod->categorie(); // Définition d'une variable contenant l'appel de la fonction detail() dans la classe Detailprod

        $aView["row"] = $aListe; // Ce qui est entre crochets est une définition de variable qui appelle le $row qui est dans le fichier detail.php
        $aView["categorie"] = $aListe2; // Ce qui est entre crochets est une définition de variable qui appelle le $categorie qui est dans le fichier detail.php

        $this->load->view('modif_produit', $aView); // Chargement de la vue et de la variable définie à la ligne précédente
    }

// MODIFICATION D'UN PRODUIT

    public function modif($pro_id) // La fonction modif() va nous permettre de modifier le produit quand on clique sur le bouton valider
    {
        $this->load->model('modifprod'); // On charge la classe Modifprod.php

        $this->modifprod->modif($pro_id); // Définition d'une variable contenant l'appel de la fonction modif() dans la classe Suppprod

        $this->load->view('modifsuccess'); // Chargement de la vue et de la variable définie à la ligne précédente
    }

// AJOUT D'UN CONTACT

    public function ajout_contact()
    {
        $this->load->helper('form', 'url');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nom', 'Votre nom', 'regex_match[/^[A-zA-ZñéèîïÉÈÎÏ][A-zA-Zñéèêàçîï]+([-\'\s][A-zA-ZñéèîïÉÈÎÏ][A-zA-Zñéèêàçîï]+)?$/]|required',
            array('regex_match' => 'Format incorrect',
                  'required' => 'Vous devez définir un nom')); // Définition des messages d'erreurs en l'absence de saisie
                $this->form_validation->set_rules('prenom', 'Votre prénom', 'regex_match[/^[A-zA-ZñéèîïÉÈÎÏ][A-zA-Zñéèêàçîï]+([-\'\s][A-zA-ZñéèîïÉÈÎÏ][A-zA-Zñéèêàçîï]+)?$/]|required',
            array('regex_match' => 'Format incorrect',
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

        else
        {
            echo "Nom : ". $_POST["nom"] . "<br>";
            echo "Prénom : ". $_POST["prenom"] . "<br>";
            echo "Vous êtes du sexe : ". $_POST["customRadio"] . "<br>";
            echo "Vous êtes né(e) le : ". $_POST["naissance"] . "<br>";
            echo "Votre code postal est le : ". $_POST["code_postal"] . "<br>";
            echo "Votre adresse est : ". $_POST["adresse"] . "<br>";
            echo "Votre ville est : ". $_POST["ville"] . "<br>";
            echo "Votre email est : ". $_POST["email"] . "<br>";
            echo "Votre sujet sélectionné est : ". $_POST["demande"] . "<br>";
            echo "Vous avez donné votre accord pour le traitement informatique de ce formulaire : ". $_POST["accord"] . "<br>";
        }
    }

// INSCRIPTION

    public function inscription()
    {
    if ($this->input->post()) // Quand on poste des données
    {
        $this->form_validation->set_rules('nom', 'Votre nom', 'regex_match[/^[A-zA-ZñéèîïÉÈÎÏ][A-zA-Zñéèêàçîï]+([-\'\s][A-zA-ZñéèîïÉÈÎÏ][A-zA-Zñéèêàçîï]+)?$/]|required',
            array('regex_match' => 'Format incorrect',
                  'required' => 'Vous devez définir un nom')); // Définition des messages d'erreurs en l'absence de saisie
        $this->form_validation->set_rules('prenom', 'Votre prénom', 'regex_match[/^[A-zA-ZñéèîïÉÈÎÏ][A-zA-Zñéèêàçîï]+([-\'\s][A-zA-ZñéèîïÉÈÎÏ][A-zA-Zñéèêàçîï]+)?$/]|required',
            array('regex_match' => 'Format incorrect',
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
            else
        {
            $this->load->model('inscription_user'); 
            $this->inscription_user->inscription();
            $this->load->view('inscripsuccess'); 
        }
    }
    else
    {
        $this->load->view('inscription'); // Chargement du formulaire d'inscription la première fois
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
            if ($this->input->post()) // Quand on poste des données
        {
        $this->form_validation->set_rules('mail', 'Email', 'valid_email|required',
                array('valid_email' => 'Vous devez saisir une adresse mail valide',
                'required' => 'Vous devez indiquer une adresse mail'));
        $this->form_validation->set_rules('password', 'Mot de passe', 'regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/]|required',
                array('regex_match' => " Votre mot de passe doit comporter de 8 à 15 caractères, au moins une lettre minuscule, au moins une lettre majuscule, au moins un chiffre, au moins un de ces caractères spéciaux : $ @ % * + - _ !",
                    'required' => 'Vous devez indiquer un mot de passe'));
        
                if ($this->form_validation->run() == FALSE) // Si la validation ne s'est pas déroulée correctement alors il y a affichage de la vue
            {
                $this->load->view('connexion');
            } 
                else
            {
                $this->load->model('connexion_user'); 
                $connex=$this->connexion_user->connexion();
        
                $password_bdd = $connex->mot_de_passe; // Récupération du mot de passe dans la BDD
                $password_form = $this->input->post('password'); // Récupération du mot de passe saisi par l'utilisateur
                $password = password_verify($password_form, $password_bdd); // Comparaison du mot de passe saisi avec le mot de passe hashé dans la BDD
                $nom = $connex->nom; // Récupération du nom pour affichage du nom sur la page d'accueil lors de la connexion
                $acces = $connex->acces; // Récupération du rôle dans la BDD
        
                if($password) // Si le mot de passe est correct
                {
                    
                    if($acces == "admin") // Si le rôle est administrateur
                    {
                        $this->session->set_userdata("admin", TRUE); // Création d'une session administrateur
                        $this->session->set_userdata("nom", $nom); // Création d'une session nom
                        $this->load->view('accueil'); // Affichage de la vue de la page accueil
                    }
                    else
                    {
                        $this->session->set_userdata("user", TRUE); // Création d'une session utilisateur
                        $this->session->set_userdata("nom", $nom); // Création d'une session nom
                        $this->load->view('accueil'); // Affichage de la vue de la page accueil
                    }
                }
            }
        }
    }

// AFFICHAGE DU FORMULAIRE DE CONNEXION QUAND ON CLIQUE SUR LE LIEN DANS L'EN TETE

    public function form_connexion()
    {
        $this->load->view('connexion');
    }

// DECONNEXION

    public function deconnexion() 
    {
        session_destroy(); // Destruction de la session
        redirect("produits/index"); // Redirection vers la page d'accueil
    }

// AJOUTER PRODUITS AU PANIER

    public function ajouterPanier() 
    {
        // On récupère les données du prduit ajouté au panier
        $aData = $this->input->post();  

        // Au 1er article ajouté, création du panier car il n'existe pas
        if ($this->session->panier == null) 
        {
            // On créé un tableau pour stocker les informations du produit  
            $aPanier = array();
    
            // On ajoute les infos du produit ($aData) au tableau du panier ($aPanier)
            array_push($aPanier, $aData);  
    
            // On stocke le panier dans une variable de session nommée 'panier'            
            $this->session->set_userdata("panier", $aPanier);

            redirect("produits/liste");

        }
        else // Le panier existe (on a déjà mis au moins un article)
        {  
    
            // On récupère le contenu du panier et on créé une session panier          
            $aPanier = $this->session->panier;
    
            // Définition de la variable $pro_id qui contient l'id du produit
            $pro_id = $this->input->post('pro_id');
    
            // Variable contenant un boolean qui permettra d'exécuter la condition utilisée plus tard
            $bSortie = FALSE;

            /* AUTRE FACON DE FAIRE LA BOUCLE AVEC UN FOREACH
            /*$i=0;
            
            // on cherche si le produit existe déjà dans le panier
            foreach ($aPanier as $produit) 
            {
                if ($produit['pro_id'] == $pro_id)
                {

                

                    echo(" i vaut ".$i." <br>");
                    echo ("avant incrémentation". $aPanier[$i]['pro_qte']);

                    $aPanier[$i]['pro_qte']++;

                    $this->session->panier = $aPanier;
                
                    var_dump( $aPanier[$i]['pro_qte']);

                    $bSortie = TRUE;
                
                }
                $i++;
            }*/
            
            // Définition de la variable $count : le chiffre de $count sera le nombre d'input du produit 
            $count = count($aPanier);

            // On parcourt les différents input du produit pour rechercher si l'id est déjà présent
            for ($i = 0; $i < $count; $i++) 
            {
                if ($aPanier[$i]["pro_id"] == $pro_id) // Si l'input pro_id est égal au chiffre défini précédemment par pro_id
                {

                    $aPanier[$i]['pro_qte']++; // Alors on augmente de 1 la quantité du produit

                    $this->session->panier = $aPanier; // Création d'une nouvelle session qui contient la quantité mise à jour

                    $bSortie = TRUE;  // Empêche l'exécution de la prochaine condition
                }        
            }

            if ($bSortie==FALSE) // Sinon, si c'est un autre produit sélectionné, on l'ajoute au panier
            { 
                array_push($aPanier, $aData); // On les données du produits $aData dans un tableau $aPanier
                 
                $this->session->panier = $aPanier; // Création d'une nouvelle session panier qui sera une nouvelle ligne dans le panier
                
            }
            redirect("produits/liste");
        }
        
    }

// MODIFIER QUANTITE

    public function modifierQuantite($pro_id,$pro_qte)
    {
    
    echo("modifierQuantite".$pro_id." ".$pro_qte);
    
        $aPanier = $this->session->panier;
     
        $aTemp = array(); //création d'un tableau temporaire vide
     
        // On parcourt le tableau produit après produit
        for ($i = 0; $i < count($aPanier); $i++) 
        {
            if ($aPanier[$i]['pro_id'] !== $pro_id)
            {
                array_push($aTemp, $aPanier[$i]);
            }
            else
            {
                $aPanier[$i]['pro_qte']=$pro_qte;
                array_push($aTemp, $aPanier[$i]);
            }
        }
     
        $aPanier = $aTemp;
        unset($aTemp);
        $this->session->set_userdata("panier", $aPanier);
     
        // On réaffiche le panier 
        redirect("produits/afficherPanier");
    }

// SUPPRIMER PRODUITS DU PANIER

    public function supprimerProduit($pro_id)
    {
        $aPanier = $this->session->panier;
    
        $aTemp = array(); // Création d'un tableau temporaire vide
    
        for ($i=0; $i<count($aPanier); $i++) // On cherche dans le panier les produits à ne pas supprimer
        {
            if ($aPanier[$i]['pro_id'] !== $pro_id)
            {
                array_push($aTemp, $aPanier[$i]); // Ces produits sont ajoutés dans le tableau temporaire
            }
        }
    
    $aPanier = $aTemp;
    unset($aTemp);
    $this->session->panier = $aPanier; // Le panier prend la valeur du tableau temporaire et ne contient donc plus le produit à supprimer
    
    // On réaffiche le panier 
    redirect("produits/afficherPanier");
    }

// SUPPRIMER PANIER

    public function supprimerPanier()
    {
        unset($_SESSION["panier"]); // Destruction de la session panier
        redirect("produits/afficherPanier"); // Redirection vers la page d'accueil
    }

// AFFICHER PANIER

    public function afficherPanier()
    {
        $this->load->view('panier');
    }

// AUTRE FACON AVEC LES ANCIENNES VUES DE PANIER
// AFFICHAGE DU PANIER

    public function cart()
    {
        $this->load->view('cart');
    }

// AUTRE FACON AVEC LES ANCIENNES VUES DE PANIER
// AJOUTER AU PANIER

    public function ajout_panier()
    {
        $this->load->model('ajoutpanier'); 

        $this->ajoutpanier->addcart();
        
        $this->load->view('cartsuccess');
    }

// AFFICHAGE DE LA VUE MOT DE PASSE PERDU
    
public function reinitialisation()
{
    $this->load->view('mdpperdu');
}

// REINITIALISATION MOT DE PASSE PERDU // NE FONCTIONNE PAS

public function mdp_perdu()
{
    if ($this->input->post()) // Quand on poste des données
{
$this->form_validation->set_rules('mail', 'Votre Email', 'valid_email|required',
        array('valid_email' => 'Vous devez saisir une adresse mail valide',
        'required' => 'Vous devez indiquer une adresse mail'));
$this->form_validation->set_rules('mot_de_passe', 'Veuillez indiquer votre nouveau mot de passe', 'regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/]|required',
        array('regex_match' => " Votre mot de passe doit comporter de 8 à 15 caractères, au moins une lettre minuscule, au moins une lettre majuscule, au moins un chiffre, au moins un de ces caractères spéciaux : $ @ % * + - _ !",
            'required' => 'Vous devez indiquer un nouveau mot de passe'));
$this->form_validation->set_rules('conf_password', 'Veuillez confirmer votre nouveau mot de passe', 'matches[mot_de_passe]|required',
        array('matches' => 'Vos deux mots de passe sont différents',
              'required' => 'Vous devez confirmer votre nouveau mot de passe'));

        if ($this->form_validation->run() == FALSE) // Si la validation ne s'est pas déroulée correctement alors il y a affichage de la vue
    {
        $this->load->view('mdpperdu');
    }
        else
    {
        $this->load->model('modif_mdp'); 

        $this->modif_mdp->mdp_perdu();

        $this->load->view('modif_mdp_success');
    }
    }
    else
    {
        $this->load->view('mdpperdu'); // Chargement du formulaire d'inscription la première fois
    }

}

}

?>