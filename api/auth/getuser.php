<?php

${basename(__FILE__, '.php')} = function(){
    if($this->isAuthenticated()){
        if($this->get_request_method() == "POST" and isset($this->_request['id'])){
            $id = $this->_request['id'];
            try{
                $user = User::getUserAccount($id);
                $data = [
                    "id" => $user['id'],
                    "username" => $user['username'],
                    "email" => $user['email'],
                    "active" => $user['active'],
                
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