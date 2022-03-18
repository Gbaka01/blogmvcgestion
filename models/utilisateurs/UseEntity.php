<?php 
class UserEntity{
    private $id;
    private $image;
    private $nom;
    private $mail;
    private $statut;
    private $isValid;
    private $mdp;
    private $linkValidation;
    public function getId(){
      return $this -> id;  
    }
    public function setId($id){
     $this->id=$id;
    }
    public function getImage(){
        return $this-> image;
    }
    public function setImage($Image){
        $this ->image=$Image;
    }
    public function getNom(){
        return $this-> nom;
    }
    public function setNom($nom){
        $this->nom=$nom;

    }
    public function getMail(){
        return $this-> mail;
    }
    public function setMail($mail){
        $this->mail=$mail;

    }
    public function getstatut(){
         return $this->statut;
    }
    public function setstatut($statut){
        $this->statut=$statut;
    }public function getIsValid(){
      return $this -> isValid;  
    }
    public function setIsValid($isValid){
     $this->isValid=$isValid;
    }
    public function getMdp(){
        return $this-> mdp;
    }
    public function setMdp($mdp){
        $this ->mdp=$mdp;
    }
    public function getLinkValidation(){
        return $this-> linkValidation;
    }
    public function setLinkValidation($linkValidation){
        $this->linkValidation=$linkValidation;

    }
   
}
?>