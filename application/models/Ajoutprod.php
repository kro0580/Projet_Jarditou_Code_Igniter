<?php

// Classe pour ajouter un produit

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajoutprod extends CI_Model // Définition des données à récuperer et à renvoyer dans la BDD
{
    public function ins($x)
    {
        $ref=$this->input->post('reference'); // post fait référence au name de l'input
        $cat=$this->input->post('categorie');
        $lib=$this->input->post('libelle');
        $desc=$this->input->post('description');
        $prix=$this->input->post('prix');
        $stock=$this->input->post('stock');
        $couleur=$this->input->post('couleur');
        $bloque=$this->input->post('bloque');
        $ajout=$this->input->post('ajout');

        $w=array(
            'pro_ref'=>$ref, // 'pro_ref' fait référence au nom de la colonne correspondat à la référence dans la BDD
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

        else // Sinon o affiche un message d'erreur
        {
            echo "Aucune catégorie de produits";
        }

        return $results;
    }
}
?>