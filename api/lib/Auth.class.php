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
            $this->oauth->authenticate();   //throws exception if token is invalid
        } else {
            $user = new User($this->username);
            $hash = $user->getPasswordHash();
            if(password_verify($this->password, $hash)) {
                if(!$user->isActive()) {
                    throw new Exception("Check your mail and verify your account.");
                } else {
                    $this->loginTokens = $this->addSession(7200);   // Gets the access and refresh tokens
                }
            } else {
                throw new Exception("Password mismatch.");
            }
        }
    }

    // Return the access and refresh tokens for the authenticated user.
    public function getAuthTokens()
    {
        return $this->loginTokens;
    }

    public function getOAuth()
    {
        return $this->oauth;
    }

    // Add a new session to the database with a valid time of 2 hours.
    public function addSession()
    {
        $oauth = new OAuth($this->username);
        $session = $oauth->newSession();
        return $session;
    }

    public static function generateRandomHash($len)
    {
        $bytes = openssl_random_pseudo_bytes($len);
        return bin2hex($bytes);
    }

    // Logout the user only with access_token and username.
    public static function logout($username)
    {
        $db = Database::getConnection();
        if($username == $_SESSION['username']) {
            $query = "DELETE FROM `session` WHERE `username` = '$username' ";
            $result = mysqli_query($db, $query);
            if ($result) {
                return true;
            } else {
                throw new Exception("Accesstoken is required to logout");
            }
        } else {
            throw new exception("Unauthorized");
        }

    }

    /**
     * delete a user account, only the user can delete their own account
     * if user updates his account
     */
    public static function delete($id)
    {
        $db = Database::getConnection();
        if ($db) {
            $query = "DELETE FROM `auth` WHERE `id` = $id and `username` = '".$_SESSION['username']."'";
            $result = mysqli_query($db, $query);

            if ($result) {
                if (mysqli_affected_rows($db) > 0) {
                    return true; // Successfully deleted
                } else {
                    throw new Exception("Unauthorized");
                }
            } else {
                throw new Exception("error: ".mysqli_error($db));
            }
        }
    }



}
