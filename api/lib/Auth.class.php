<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/Database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/User.class.php');
require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";

class Auth{
    private $username;
    private $password;
    private $db;
    private $token;
    private $isTokenAuth = false;


    public function __construct($username, $password = null){
        $this->db = Database::getConnection();
        if($password == null){
            //token based auth
            $this->token = $username;
            $this->isTokenAuth = true;

        }else{
            //password based auth
            $this->username = $username;
            $this->password = $password;
        }

        if($this->isTokenAuth){

        }else{
            $user = new User($this->username);
            $hash = $user->getPasswordHash();
            if(password_verify($this->password, $hash)){
                if(!$user->isActive()){
                    throw new Exception("Check your mail and verify your account.");
                }else{
                    throw new Exception("Login successfull.");
                }
            }else{
                throw new Exception("Password mismatch.");
            }
        }
    }
}
?>