<?php

${basename(__FILE__, '.php')} = function(){
    if($this->isAuthenticated()){
        if($this->get_request_method() == "POST"){
            try{
                $users = User::getAllaccounts();
                if(empty($users)){
                    throw new Exception("No users found");
                }

                $data = [
                    "users" => $users // Return all users in an array
                ];
                $data = $this->json($data);
                $this->response($data, 200);
            }catch(Exception $e){
                $data = [
                    "error" => $e->getMessage(),
                ];
                $data = $this->json($data);
                $this->response($data, 406);
            }
        }else{
            $data = [
                "error" => "Bad request",
            ];
            $data = $this->json($data);
            $this->response($data, 400);
        }
    }else{
        $data = [
            "error" => "Not authenticated",
        ];
        $data = $this->json($data);
        $this->response($data, 401);
    }

};