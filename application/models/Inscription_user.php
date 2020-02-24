<?php

// Classe pour ajouter un user

defined('BASEPATH') OR exit('No direct script access allowed');

class Inscription_user extends CI_Model // Définition des données à récuperer et à renvoyer dans la BDD
{
    public function inscription()
    {
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d H:i:s"); // Format de date avec codeigniter

        $nom=$this->input->post('nom', TRUE); // post fait référence au name de l'input
        $prenom=$this->input->post('prenom', TRUE);
        $email=$this->input->post('email', TRUE);
        $log=$this->input->post('identifiant', TRUE);
        $password=$this->input->post('password', TRUE);
        $password_hash=password_hash($password, PASSWORD_DEFAULT);

        $data=array(
            'nom'=>$nom, // 'nom' fait référence au nom de la colonne correspondant au nom dans la BDD
            'prenom'=>$prenom,
            'mail'=>$email,
            'identifiant'=>$log,
            'mot_de_passe'=>$password_hash,
            'date_inscription'=>$date
        );

        $this->db->insert('users',$data); // Insertion des données dans la table produits
    }
}

?>