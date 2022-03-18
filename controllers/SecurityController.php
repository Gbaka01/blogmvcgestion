<?php 
class SecurityController{
    public static function secureHTML($data){
        return htmlspecialchars($data);
    }
    
    public static function isLog(){
        if(empty($_SESSION["user"])){
             return false;
            }else 
            {
             return true;
             }
}
}
?>