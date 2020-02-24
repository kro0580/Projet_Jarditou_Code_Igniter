<?php

// Classe pour ajouter un produit

// TRUE permet d'éviter les failles XSS : pour afficher une valeur saisie dans un formulaire, passer un second argument TRUE aux méthodes $this->input->post()
// LES REQUETE PREPAREES permettent d'évitrer les injections SQL : Ces méthodes ont, notamment : query(), insert(), update()

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajoutprod extends CI_Model // Définition des données à récuperer et à renvoyer dans la BDD
{
    public function ins($x)
    {
        $ref=$this->input->post('reference', TRUE); // post fait référence au name de l'input
        $cat=$this->input->post('categorie', TRUE);
        $lib=$this->input->post('libelle', TRUE);
        $desc=$this->input->post('description', TRUE);
        $prix=$this->input->post('prix', TRUE);
        $stock=$this->input->post('stock', TRUE);
        $couleur=$this->input->post('couleur', TRUE);
        $bloque=$this->input->post('bloque', TRUE);
        $ajout=$this->input->post('ajout', TRUE);

        $w=array(
            'pro_ref'=>$ref, // 'pro_ref' fait référence au nom de la colonne correspondant à la référence dans la BDD
            'pro_cat_id'=>$cat,
            'pro_libelle'=>$lib,
            'pro_description'=>$desc,
            'pro_prix'=>$prix,
            'pro_stock'=>$stock,
            'pro_couleur'=>$couleur,
            'pro_bloque'=>$bloque,
            'pro_d_ajout'=>$ajout,
            'pro_photo'=>$x

        );

        $this->db->insert('produits',$w); // Insertion des données dans la table produits
    }

    public function categorie()
    {
        $this->load->database();

        $requete = $this->db->get('categories'); // Requête pour afficher les catégories
        
        if($requete->num_rows() > 0) // Si la liste contient au moins une ligne, on affiche le résultat
        {
            $results = $requete->result();
        }

        else // Sinon on affiche un message d'erreur
        {
            echo "Aucune catégorie de produits";
        }

        return $results;
    }
}
?>