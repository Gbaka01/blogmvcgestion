<?php 
class UserManager extends Manager{
public function getPasswordUser($mail){
// cherche le mdp de la bdd en fonction du mail
$sql="SELECT mdp FROM utlisateur WHERE mail=?";
$param=[$mail];
$res=$this->getDb()->prepare($sql);
$res->execute($param);
$pass=$res->fetch();
return $pass["mdp"];
        }
        



public function verifyPassword($mail, $password){
 // utiliser getpasswordUser pour aller chercher
 // le mdp crypté en fonction du mail   
// utilisation de passwordverify pour vérifier les mdp

$mdp=$this->getPasswordUser($mail);
return password_verify($password, $mdp);
}
public function accountValid($mail){
// cherche le mdp de la bdd en fonction du mail
$sql="SELECT isValid FROM utlisateur WHERE mail=?";
$param=[$mail];
$res=$this->getDb()->prepare($sql);
$res->execute($param);
$valid=$res->fetch();
return ($valid['isValid']=="0")? false : true;
        }
        public function getInfosUser($mail){
           $sql="SELECT * FROM utlisateur WHERE mail=?";
$param=[$mail];
$res=$this->getDb()->prepare($sql);
$res->execute($param);
$infos=$res->fetch(PDO::FETCH_ASSOC);
$res->closeCursor();
return $infos;
        }
        public function AddAccount($nom,$mail,$mdp,$linkValidation){
       
        
                $sql="INSERT INTO utlisateur(nom,mail,mdp,linkValidation) values (?,?,?,?)";
$param=[$nom,
        $mail,
$mdp,
$linkValidation];
$res=$this->getDb()->prepare($sql);
$res->execute($param);
$infos=$res->fetch(PDO::FETCH_ASSOC); 
 $infos->closeCursor();    
        }

}

?>