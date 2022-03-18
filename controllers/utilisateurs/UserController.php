<?php 
require_once "models/utilisateurs/UserManager.php";
require_once "models/Dbconnect.class.php";
require_once "models/utilisateurs/UseEntity.php";

class UserController extends AbstractController{
    private $base;
    private $UserManager;
    private $user;
    public function __construct(){
$this->base=new Dbconnect();
$this->UserManager= new UserManager($this->base);
$this->user= new UserEntity();
    }
    public function loginValidation(){
        
        $data=$this->checkdata();
        
$connexion=$this->UserManager->verifyPassword($data["mail"],$data["mdp"]);
   if($connexion){
       if($this->UserManager->accountValid($data["mail"])){
       self::MessageAlerte("Tu es connecté", self::VERTE);
        $_SESSION['user']=[
        'mail'=>$data["mail"]
];
       header("Location: " .URL. "account/profile");
    
   }else{
        self::MessageAlerte("Attention ton compte n'est pas connecté, ERREUR", self::VERTE);
        header("Location: " .URL. "login");
   }
}else{
        self::MessageAlerte("pas connecté, ERREUR", self::ROUGE);
        header("Location: " .URL. "login");
   }
  
}
 public function myProfile(){
     $mail=$_SESSION["user"]["mail"];
       $infos=$this->UserManager->getInfosUser($mail);
       $data=[
         'titre'=> "Mon Profil",
         'tableau'=> $infos,
        
         'view'=> 'views/utilisateurs/profile.view.php'
       ];
       $this->genererPage($data);
   }
public function logout(){
    unset($_SESSION["user"]);
  self::MessageAlerte("Vous êtes bien déconnectés", self::VERTE);
  header("Location: ".URL."accueil");
}

 public function AccountValidation(){
  $data=$this->checkdata();
  $crypt=password_hash($data["mdp"], PASSWORD_DEFAULT);
  $linkValidation=rand(0,9999);
  $nom=$data["name"];
  $mail=$data["mail"];

  $recup=$this->UserManager->AddAccount($nom, $mail,$crypt,$linkValidation);
  

} 

}


?>