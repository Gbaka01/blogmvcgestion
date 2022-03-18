<?php 
class VisitorController extends AbstractController{
public function home(){
$data=[
            'titre'=>"Accueil",
            'view'=>'views/Visiteurs/home.view.php',
        ];
       $this->genererPage($data);
    


}
public function login(){
$data=[
            'titre'=>"Connexion",
            'view'=>'views/Visiteurs/login.view.php',
        ];
       $this->genererPage($data);
}
public function CreateAccount(){
   $data=[
         'titre'=> "Inscription",
        
         'view'=> 'views/visiteurs/CreateAccount.view.php'
       ];
       $this->genererPage($data);
   }
  

}
?>