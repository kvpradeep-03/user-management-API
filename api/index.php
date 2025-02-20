<?php

require_once($_SERVER['DOCUMENT_ROOT']."/api/REST.api.php");
require_once($_SERVER['DOCUMENT_ROOT']."/api/lib/Database.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/api/lib/Signup.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/api/lib/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/api/lib/Auth.class.php");


class API extends REST
{
    public $data = "";
    public $current_call;
    private $db = null;

    public function __construct()
    {
        parent::__construct();                  // Init parent contructor
        $this->db = Database::getConnection();  // Initiate Database connection
    }

    /*
     * Function: Public method for access api.
     * Purpose: This method dynmically call the method based on the query string
     *
     * steps:
     * 1. the requested API method from the 'rquest' parameter, remove slashes, trim spaces, and convert it to lowercase.
     * 2. Check if the method exists in this class. If it does, call the function dynamically.
     * 3. If the requested method does not exist, return an HTTP 400 response (Bad Request).
     */
    public function processApi()
    {
        $func = strtolower(trim(str_replace("/", "", $_REQUEST['rquest'])));
        if(method_exists($this, $func) > 0) {  //checks if the method exists in the current class
            $this->$func();
        } else {
            if(isset($_GET['namespace'])) {
                $dir = $_SERVER['DOCUMENT_ROOT'].'/api/'.$_GET['namespace'];
                $file = $dir.'/'.$func.'.php';

                if(file_exists($file)) {
                    include $file;
                    $this->current_call = Closure::bind(${$func}, $this, get_class());  //binds function to the current class
                    $this->$func();
                }
            } else {
                //we can even process functions without namespace here.
                $this->response($this->json(['error' => 'methood_not_found']), 404);
            }
        }
    }

    /*************API SPACE START*******************/

    private function about()
    {

        if($this->get_request_method() != "POST") {
            $error = array('status' => 'WRONG_CALL', "msg" => "The type of call cannot be accepted by our servers.");
            $error = $this->json($error);
            $this->response($error, 406);
        }
        $data = array('version' => $this->_request['version'], 'desc' => 'This API is created by Blovia Technologies Pvt. Ltd., for the public usage for accessing data about vehicles.');
        $data = $this->json($data);
        $this->response($data, 200);

    }


    private function test()
    {
        $data = $this->json(getallheaders());
        $this->response($data, 200);
    }

    private function request_info()
    {
        $data = $this->json($_SERVER);
    }

    public function generate_hash()
    {
        $bytes = random_bytes(16);
        return bin2hex($bytes);
    }

    public function __call($method, $args)
    {
        if(is_callable($this->current_call)) {
            return call_user_func_array($this->current_call, $args);
        } else {
            $this->response($this->json(['error' => 'method_not_callable']), 404);
        }
    }




    /*************API SPACE END*********************/

    /*
        Encode array into JSON
    */
    private function json($data)
    {
        if(is_array($data)) {
            return json_encode($data, JSON_PRETTY_PRINT);
        } else {
            return "{}";
        }
    }

}

// Initiiate Library

$api = new API();
$api->processApi();
