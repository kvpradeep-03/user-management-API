<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/Database.class.php');
require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
class User{
    private $db;
    private $user;
    private $username;
    public function __construct($username){
        $this->username = $username;
        $this->db = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `username` = '$username';";
        $result = mysqli_query($this->db, $query);
        if(mysqli_num_rows($result) == 1){
            $this->user = mysqli_fetch_assoc($result);

        }else{
            throw new Exception("User not found.");
        }
    
    }

    public function getUsername(){
        return $this->user['username'];
    }

    public function getPasswordHash(){
        return $this->user['password'];
    }

    public function getEmail(){
        return $this->user['email'];
    }

    public function isActive(){
        return $this->user['active'];
    }
    
    // Get a specific user account by id
    public static function getUserAccount($id){
        $db = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `id` = $id";
        $result = mysqli_query($db, $query);
        if($result){
            $data = mysqli_fetch_assoc($result);
            return $data;
        }
    }

    // Get all user accounts
    public static function getAllaccounts(){
        $db = Database::getConnection();
        $query = "SELECT * FROM `auth`";
        $result = mysqli_query($db, $query);
        if($result){
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $users;
        }else{
            return [];  // Return an empty array if no result
        }
        
    }

}