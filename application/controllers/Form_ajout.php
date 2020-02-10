<?php

class Form_ajout extends CI_Controller {

    public function form_ajout()
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
                    echo "Produit ajouté avec succès";
                }
                else
                {
                    echo "Produit refusé";
                }
                
        }    

}