<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/Database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/User.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/OAuth.class.php');
require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";

class Auth
{
    private $username;
    private $password;
    private $db;
    private $token;
    private $isTokenAuth = false;
    private $loginTokens = null;
    private $oauth;


    public function __construct($username, $password = null)
    {
        $this->db = Database::getConnection();
        if($password == null) {
            //token based auth
            $this->token = $username;
            $this->isTokenAuth = true;

        } else {
            //password based auth
            $this->username = $username;
            $this->password = $password;
        }

        if($this->isTokenAuth) {
            $this->oauth = new OAuth($this->token);
            $this->oauth->authenticate();
        } else {
            $user = new User($this->username);
            $hash = $user->getPasswordHash();
            if(password_verify($this->password, $hash)) {
                if(!$user->isActive()) {
                    throw new Exception("Check your mail and verify your account.");
                } else {
                    $this->loginTokens = $this->addSession(7200);
                }
            } else {
                throw new Exception("Password mismatch.");
            }
        }
    }

    public function getAuthTokens(){
        return $this->loginTokens;
    }
    
    /**
     * returns the username of authenticated user.
     */
    public function getUserName()
    {
        if($this->oauth->authenticate()) {
            return $this->oauth->getUserName();
        }
    }

    public function getOAuth()
    {
        return $this->oauth;
    }
    public function addSession(){
        $oauth = new OAuth($this->username);
        $session = $oauth->newSession();
        return $session;
    }

    public static function generateRandomHash($len){
        $bytes = openssl_random_pseudo_bytes($len);
        return bin2hex($bytes);
    }
}
