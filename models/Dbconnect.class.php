<?php 

class Dbconnect extends PDO{
    private $dsn;
    private $username;
    private $passwd;
    private $options;

public function __construct(){
    $dsn="mysql:host=localhost;dbname=greta91;port=3306";
    $username="root";
    $passwd="";
    $options=[];
    parent::__construct($dsn,$username,$passwd,$options);
    
}

}

?>