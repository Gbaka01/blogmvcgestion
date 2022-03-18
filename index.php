<?php
session_start();
?>


<?php
// index.php est le routeur de l'application
// Définition d'une constante URL
// Constante qui rédéfinit un lien absolu depuis
// http ou https. Str_replace sert juste à supprimer
define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS'])?"https":"http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
require_once "controllers/ArticleController.php";
require_once "controllers/visiteurs/VisitorController.php";
require_once "controllers/utilisateurs/UserController.php";
require_once "controllers/SecurityController.php";
$article= new ArticleController();
$visitor= new VisitorController();
$user= new UserController();
$security= new SecurityController();
try{
if (empty($_GET['page'])){
$visitor->home();
}else{
    $url= explode("/",filter_var($_GET['page'], FILTER_SANITIZE_URL));
    
    switch($url[0]){
        case "accueil" :$visitor->home(); 
        break;
        case "login" :$visitor->login();
        break;
        case "loginValidation" :$user->loginValidation();
        break;
        case "CreateAccount" :$visitor->CreateAccount();
        break;
        case "AccountValidation" :$user->AccountValidation();
        break;
        case "account":
             if($security->isLog()){
                 
             switch($url[1]){
             case "profile" :
            $user->myProfile();
            break;                    
            case "logout" :
            $user->logout();
             break;
             default :throw new Exception("Non existant");
            } 
           }else 
           {
               AbstractController::MessageAlerte('Vous devez vous connecter', AbstractController::VERTE);
           header("Location: ".URL."accueil");
             }
            break;
        case "article" : 
            if(empty($url[1])){
                $article->afficher_articles();
            }elseif($url[1]==="add"){
                $article->formAdd();
            }elseif($url[1]==="validation"){
                $article->addValidation();
            }elseif($url[1]==="delete"){
                $article->deleteArticle($url[2]);
            }elseif($url[1]==="update"){
                $article->updateFormArticle($url[2]);
            }elseif($url[1]==="updateValidation"){
                $article->updateValidation($url[2]);
            }

            
            else
            {
                throw new Exception("La page n'existe pas");
            }
           
    
             
        }
    }
}
catch(Exception $e){
    $msg= $e->getMessage();
require 'views/error.view.php';
}

?>