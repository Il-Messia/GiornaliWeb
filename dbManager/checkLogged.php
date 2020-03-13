<?php

include 'connect.php';

class loginManager
{
    private $logged;
    private $username;
    private $accounttype;
    private $con;

    public function logout()
    {
        $this->logged = false;
        $this->username = null;
        $this->accounttype = "lettore";
        $this->saveToSession();
        $this->con->closeConnection();
        $this->con->setUsername(2);
        $this->con->connect();
    }

    public function saveToSession()
    {
        $_SESSION['username'] = $this->username;
        $_SESSION['accounttype'] = $this->accounttype;
    }
    public function toNumber(){
        switch($this->accounttype){
            case 'admin':
                return 1;
            break;
            case 'lettore':
                return 2;
            break;
            case 'validatore':
                return 3;
            break;
            case 'scrittore':
                return 4;
            break;
        }
    }
    public function login($user, $pass)
    {
        $this->logged = false;
        $this->con->setUsername(2);
        $this->con->connect();
        $query = "SELECT Username,PassWord, TipoAccount FROM account";
        $res = $this->con->runQuery($query);
        $this->con->closeConnection();
        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) {

                $temppsw = sha1($pass);

                if ($user === $row["Username"] && $temppsw === $row["PassWord"]) {
                    $this->logged = true;
                    $this->con->setUsername($row["TipoAccount"]);
                    switch ($row["TipoAccount"]) {
                        case 1:
                            $this->accounttype = "admin";
                            break;
                        case 2:
                            $this->accounttype = "lettore";
                            break;
                        case 3:
                            $this->accounttype = "validatore";
                            break;
                        case 4:
                            $this->accounttype = "scrittore";
                            break;
                        default:
                            $this->accounttype = "lettore";
                            break;
                    }

                    $this->username = $row["Username"];
                    $this->saveToSession();
                }

                $this->con->connect();
            }
        } else {
        }
    }
    function __construct()
    {
        session_start();
        $this->con = new dbManager;
        if (isset($_SESSION['username']) && isset($_SESSION['accounttype'])) {
            $this->logged = true;
            $this->username = $_SESSION['username'];
            $this->accounttype = $_SESSION['accounttype'];
        } else {
            $this->logged = false;
            $this->username = "Prova user";
            $this->accounttype = "lettore";
        }
    }
    function getStatus()
    {
        if (isset($this->logged)) {
            return $this->logged;
        }
        return false;
    }
    function getUsername()
    {
        if (isset($this->username)) {
            return $this->username;
        }
        return null;
    }
    function getAccounttype()
    {
        if (isset($this->accounttype)) {
            return $this->accounttype;
        }
        return null;
    }
}
?>