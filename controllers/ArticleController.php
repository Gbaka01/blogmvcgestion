<?php 
require_once "./models/Blog.class.php";
require_once "./models/Dbconnect.class.php";
require_once "./models/Manager.class.php";
require_once "AbstractController.php";
class ArticleController extends AbstractController{
private $Manager;
private $blog;
private $base;

public function __construct(){
    $this->base= new Dbconnect();
    $this->Manager= new Manager($this->base);
    $this->blog=new Blog();
}


    public function afficher_articles(){
        $tableau =$this->Manager->getContenuParDate();
        $data=[
            'titre'=>"Mes articles",
            'tableau'=>$tableau,
            'view'=>'views/article.view.php',
        ];
       $this->genererPage($data);
    
        

    }
public function formAdd(){
    require "views/add.view.php";
}
public function addValidation(){
  $this->checkImage();
  $data=$this->checkData();
  $this->addArticle($data["titre"], $data["commentaire"], $_FILES["photo"]["name"]);  
}
public function checkImage(){
        if($_FILES["photo"]["error"]){
        switch($_FILES["photo"]["error"]){

            case 1 : //UPLOAD_ERR_OK
                throw new Exception (" Aucune erreur, le téléchargement est correct.");
                break;
            case 2 : //UPLOAD_ERR_INI_SIZE
                throw new Exception ("Valeur : 1. La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini.");
                break;
            case 3 : //UPLOAD_ERR_FORM_SIZE
                throw new Exception (" La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.");
                break;
            case 4 : // UPLOAD_ERR_PARTIAL
                throw new Exception (" Le fichier n'a été que partiellement téléchargé.");
                break;
            case 5 : // UPLOAD_ERR_NO_FILE
                throw new Exception (" Aucun fichier n'a été téléchargé.");
                break;
            case 6 : // UPLOAD_ERR_NO_TMP_DIR
                throw new Exception (" Un dossier temporaire est manquant.");
                break;
            case 7 : // UPLOAD_ERR_CANT_WRITE
                throw new Exception (" Échec de l'écriture du fichier sur le disque.");
                break;
            case 8 : // UPLOAD_ERR_EXTENSION
            throw new Exception ("Une extension PHP a arrêté l'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L'examen du phpinfo() peut aider.");
            break;
        
        
        }
    }
        else{
    
            if((isset($_FILES["photo"]["name"])) && ($_FILES["photo"]["error"] == UPLOAD_ERR_OK)){ // ou == 0
            $chemin=$_SERVER["DOCUMENT_ROOT"].'/blogmvc/public/assets/images/';
            // Déplacement du fichier du répertoire temporaire vers le répertoire de destination avec la fonction
           move_uploaded_file($_FILES["photo"]["tmp_name"],$chemin.$_FILES["photo"]["name"]);
        
        } else {
            throw new exception( "le fichier n'a pas pu être copié dabs votre dossier");
            
        }
}
    
     //$base= new Dbconnect();

// 	$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $manager=new Manager($base);
//     //Check du $_POST avec structure classique
//     $titre=(isset($_POST["titre"]) && !empty($_POST["commentaire"])) ? htmlspecialchars($_POST["titre"]) : null;
//     $commentaire=(isset($_POST["commentaire"]) && !empty($_POST["commentaire"])) ? htmlspecialchars($_POST["commentaire"]) : null;
//     if ($titre && $commentaire){
//         $blog=new Blog();
//         $blog->setTitre($titre);
//         $blog->setDate(date("Y-m-d H:i:s"));
//         $blog->setCommentaire($commentaire);
//         $blog->setPhoto($_FILES["photo"]["name"]);
//         $manager->insertionContenu($blog);
//     }
// } catch (Exception $e){

// }

}
public function checkdata(){
foreach($_POST as $key=>$value){
    $valid=(isset($value) && !empty($value))?htmlspecialchars($value): null;
if($valid==null){
    throw new Exception("Données pas bon");
}
$tab[$key]=$valid;
}
return $tab;
}
public function addArticle($titre, $commentaire, $photo){
    $this->blog->setTitre($titre);
    $this->blog->setCommentaire($commentaire);
    $this->blog->setPhoto($photo);
    $this->blog->setDate(date("Y-m-d H:i:s"));
    $this->Manager->insertionContenu($this->blog);
     $_SESSION['alert']=[
        'type'=>  'success',
        'msg'=> 'Ajout réalisé'
     ];
      self::MessageAlerte('Ajout réalisé', self::VERTE);
header("Location: " .URL. "article");
}
public function deleteArticle($id){
    $nomImage=$this->Manager->getArticleById($id)->getPhoto();
    unlink("public/assets/images/".$nomImage);
    $this->Manager->deleteById($id);
    header("Location: " .URL. "article");
         $_SESSION['alert']=[
        'type'=>  'danger',
        'msg'=> 'Suppression réalisé'
     ];
     self::MessageAlerte('Article supprimé', self::ROUGE);
}
public function updateFormArticle($id){
    $article=$this->Manager->getArticleById($id);
require"views/updateFormArticle.view.php";
     $_SESSION['alert']=[
        'type'=>  'warning',
        'msg'=> 'modification réalisé'
     ];
 self::MessageAlerte('article modifié', self::ORANGE);
}
public function updateValidation($id){
    $data=$this->checkData();
    $article=$this->Manager->getArticleById($id);
    $nomImage=$article->getPhoto();
    if($_FILES["photo"]["size"]> 0){
        unlink("public/assets/images/" .$nomImage);
        $this->checkImage();
        $article->setPhoto($_FILES["photo"]["name"]);
    }
    $article->setTitre($data["titre"]);
    $article->setCommentaire($data["commentaire"]);
    $article->setDate(date('Y-m-d H:i:s'));
    $this->Manager->updateContenu($article,$id);
   

    header("Location: " .URL. "article");
}

}

