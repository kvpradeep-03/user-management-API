<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/Auth.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/User.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/Database.class.php');

class OAuth
{
    private $db;
    private $access_token;
    private $refresh_token;
    private $valid_for = 7200;
    private $user;
    private $username;


    public function __construct($token = null)
    {
        $this->db = Database::getConnection();
        if($token != null) {
            if(str_starts_with($token, 'a.')) {
                $this->access_token = $token;
            } elseif(str_starts_with($token, 'r.')) {
                $this->refresh_token = $token;
            } else {
                $this->setUsername($token);
            }
        }
    }

    public function setUsername($username)
    {
        $this->username = $username;
        $this->user = new User($this->username);
    }

    public function getUsername()
    {
        return $this->username;
    }

    // Checks if the access token is valid.
    public function authenticate()
    {
        if($this->access_token != null) {
            $query = "SELECT * FROM `session` WHERE `access_token` = '$this->access_token'";
            $result = mysqli_query($this->db, $query);
            if($result) {
                $data = mysqli_fetch_assoc($result);
                $created_at = strtotime($data['created_at']);
                $expires_at = $created_at + $data['valid_for'];
                if(time() <= $expires_at) {
                    if(session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $this->username = $_SESSION['username'] = $data['username'];
                    $_SESSION['token'] = $this->access_token;
                    return true;
                } else {
                    throw new Exception("Expired token");
                }
            } else {
                throw new Exception("Error: ". mysqli_error($this->db));
            }
        }
    }

    /**
     * Creates a new session for the user.
     * can be used to create a new session (in default auth_grant) or refresh an existing session.
     */
    public function newSession($valid_for = 7200, $reference_token = 'auth_grant')
    {
        if($this->username == null) {
            throw new exception("Username not set for OAuth.");
        }
        $this->valid_for = $valid_for;
        $this->access_token = 'a.'.Auth::generateRandomHash(32);
        if($reference_token == 'auth_grant') {
            $this->refresh_token = 'r.'.Auth::generateRandomHash(32);
        } else {
            $this->refresh_token = "d.".Auth::generateRandomHash(16);
        }

        $query = "INSERT INTO `session` (`username`, `access_token`, `refresh_token`, `valid_for`, `reference_token`)
                  VALUES ('$this->username', '$this->access_token', '$this->refresh_token', $this->valid_for, '$reference_token');";

        if(mysqli_query($this->db, $query)) {
            return array(
                "access_token" => $this->access_token,
                "refresh_token" => $this->refresh_token,
                "valid_for" => $this->valid_for,
                "reference_token" => $reference_token
            );
        } else {
            throw new Exception("Unable to create session.");
        }
    }

    /**
     * Refreshes the access token after its expiry by the refresh token.
     * Both the access token and refresh token are updated.
     * Again the after refresh token it receives a dummy token (as a refresh token) which cannot be used to refresh the access.
     * In that situation make the user login via password authentication.
     */
    public function refreshAccess()
    {
        if($this->refresh_token != null and !str_starts_with($this->refresh_token, 'd.')) {
            $query = "SELECT * FROM `session` WHERE `refresh_token` = '$this->refresh_token'";
            $result = mysqli_query($this->db, $query);
            if($result) {
                $data = mysqli_fetch_assoc($result);
                if($data['valid'] == 1) {
                    $this->setUsername($data['username']);
                    return $this->newSession(7000, $this->refresh_token);

                } else {
                    throw new Exception("Expired token");
                }

            } else {
                throw new Exception("Error: ". mysqli_error($this->db));
            }
        } else {
            throw new Exception("Invalid request");
        }
    }

}
