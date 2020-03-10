<?php

class loginManager{
    private $logged;
    private $username;
    private $accounttype;

    public function logout(){
        $this->logged = false;
        $this->username = null;
        $this->accounttype = null;
    }

    function __construct(){
        session_start();
        if(isset($_SESSION['username'])&&isset($_SESSION['accounttype'])){
            $this->logged = true;
            $this->username = $_SESSION['username'];
            $this->accounttype = $_SESSION['accounttype'];
        }else{
            $this->logged = false;
            $this->username = "Prova user";
            $this->accounttype = "Prova tipo";
        }
    }
    function getStatus(){
        if(isset($this->logged)){
            return $this->logged;
        }
        return false;
    }
    function getUsername(){
        if(isset($this->username)){
            return $this->username;
        }
        return null;
    }
    function getAccounttype(){
        if(isset($this->accounttype)){
            return $this->accounttype;
        }
        return null;
    }

}
?>