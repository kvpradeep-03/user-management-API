<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/Database.class.php');
require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
class User
{
    private $db;
    private $user;
    private $username;
    public function __construct($username)
    {
        $this->username = $username;
        $this->db = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `username` = '$username';";
        $result = mysqli_query($this->db, $query);
        if(mysqli_num_rows($result) == 1) {
            $this->user = mysqli_fetch_assoc($result);

        } else {
            throw new Exception("User not found.");
        }

    }

    public function getUsername()
    {
        return $this->user['username'];
    }

    public function getPasswordHash()
    {
        return $this->user['password'];
    }

    public function getEmail()
    {
        return $this->user['email'];
    }

    public function isActive()
    {
        return $this->user['active'];
    }

    // Get a specific user account by id
    public static function getUserAccount($id)
    {
        $db = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `id` = $id";
        $result = mysqli_query($db, $query);
        if($result) {
            $data = mysqli_fetch_assoc($result);
            return $data;
        }
    }

    // Get all user accounts
    public static function getAllaccounts()
    {
        $db = Database::getConnection();
        $query = "SELECT * FROM `auth`";
        $result = mysqli_query($db, $query);
        if($result) {
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // Remove sensitive fields
            foreach ($users as &$user) {
                unset($user['password'], $user['token']);
            }
            return $users;
        } else {
            return [];  // Return an empty array if no result
        }

    }

    public static function updateUser($id, $new_username, $new_password, $new_email)
    {
        session_start();
        $db = Database::getConnection();
        $new_password = password_hash($new_password, PASSWORD_BCRYPT);
        $query = "UPDATE `auth` SET `username` = '$new_username', `password` = '$new_password', `email` = '$new_email' WHERE `id` = $id and `username` = '$_SESSION[username]'";
        $result = mysqli_query($db, $query);
        if($result) {
            if(mysqli_affected_rows($db) > 0) {
                // Fetch the updated user data
                $query = "SELECT `id`, `username`, `email` FROM `auth` WHERE `id` = $id";
                $result = mysqli_query($db, $query);
                if($result) {
                    $data = mysqli_fetch_assoc($result);
                    // **Force update session**
                    $_SESSION['username'] = $new_username; // Manually set new username
                    return $data;
                } else {
                    throw new Exception("Unable to fetch updated user data.");
                }
            } else {
                throw new Exception("Unable to update user account.");
            }
        }

    }


}
