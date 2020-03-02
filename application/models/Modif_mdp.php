<?php

// Classe pour modifier le mot de passe

defined('BASEPATH') OR exit('No direct script access allowed');

class Modif_mdp extends CI_Model // Définition des données à récuperer et à renvoyer dans la BDD
{
    public function mdp_perdu()
    {
      $mail=$this->input->post('mail', TRUE);
      
      $password=$this->input->post('mot_de_passe', TRUE); // Récupération du mot de passe saisi par l'utilisateur
      $conf_password=$this->input->post('conf_password', TRUE); // Récupération de la confirmation de mot de passe saisie par l'utilisateur
      if($password == $conf_password) // Comparaison des deux mots de passe saisis par l'utilisateur
      {
      $password_hash=password_hash($password, PASSWORD_DEFAULT);
      }

      $data=array(
        'mail'=>$mail,
        'mot_de_passe'=>$password_hash,
    );

    $this->db->where('mail', $mail);
    $this->db->update('users',$data); // Insertion des données dans la table users
    }
}
?>