<?php
require_once "AbstractController.php";

class HomeController extends AbstractController {
    public function afficher_home(){
        $data=[
            'titre'=>"Accueil",
            'view'=>"views/home.view.php",
        ];
        $this->genererPage($data);
    }
}

?>