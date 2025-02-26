<?php

${basename(__FILE__, '.php')} = function(){
    if($this->get_request_method() == "POST" and $this->isAuthenticated() and isset($this->_request['id'])){
        try{
            Auth::delete($this->_request['id']);
            $data = [
                "message" => 'Account Deletion Success',
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

};