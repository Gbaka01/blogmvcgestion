<?php 
// class qui va manager les demandes à la BDO
// = ORM(objet relational Mapping)
require_once "Blog.class.php";

class Manager{
    private $base;
    public function __construct($base){
        $this->setDb($base);
    }
    public function setDb(PDO $base){
        $this->base=$base;
    }
    public function getDb(){
        return $this->base;
    }
    public function getContenuParDate(){
        $tableau= array();
        $compteur= 0;
        $resultat=$this->base->query('SELECT * FROM contenu ORDER BY Date');
        while($ligne=$resultat-> fetch()){
            $blog= new Blog();
            $blog->setId($ligne['id']);
            $blog->setTitre($ligne['Titre']);
            $blog->setDate($ligne['Date']);
            $blog->setCommentaire($ligne['Commentaire']);
            $blog->setPhoto($ligne['Photo']);
            $tableau[$compteur]=$blog;
            $compteur ++;
        }
        $resultat->closeCursor();
        return $tableau;
    }
    public function insertionContenu(Blog $blog){
        $sql='INSERT INTO contenu(Titre, Date, Commentaire, Photo) value(?,?,?,?)';
        $param=[$blog->getTitre(), $blog->getDate(), $blog->getCommentaire(), $blog->getPhoto()];
        $res= $this->base->prepare($sql);
        $res->execute($param);
    }
    public function deleteById($id){
        $resultat=$this->base->prepare('DELETE FROM contenu WHERE id=?');
        $param=[$id];
        $resultat->execute($param);
    }
    public function getArticleById($id){
        $resultat=$this->base->prepare('SELECT * FROM contenu WHERE id=?');
        $param=[$id];
        $resultat->execute($param);
        $ligne=$resultat->fetch();
        if(!empty($ligne)){
            $blog= new blog();
            $blog->setID($ligne['id']);
            $blog->setTitre($ligne['Titre']);
            $blog->setCommentaire($ligne['Commentaire']);
            $blog->setDate($ligne['Date']);
            $blog->setPhoto($ligne['Photo']);
            $resultat->closeCursor();
            return $blog;
        }else{
            throw new Exception("Article n'existe pas");
        }
}
 public function updateContenu($article, $id){
     $resultat=$this->base->prepare('UPDATE contenu SET
     Titre=?,
     Date=?,
     Commentaire=?,
     Photo=?
     WHERE id=?');
     $param=[$article->getTitre(),$article->getDate(), $article->getCommentaire(), $article->getPhoto(),$id];
     $resultat->execute($param);
     $resultat->closeCursor();
 }
    }



?>