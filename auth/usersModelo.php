<?php
include __DIR__ . '/../shared/config/connection.php';
include 'users.php'; 

class UserModelo {

    private $db;

    public function __construct() {
       $this->db =  new Connection();
    }

   public function validarUser($userName, $password){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE userName = :userName");
        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
        $stmt->execute(); 
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return "true";
        } else {
            return "false";
            
        }

   }
}


$user = new UserModelo();


print_r($user->validarUser('wilder', '123'));

