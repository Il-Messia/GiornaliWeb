<?php

    class dbManager{
        private $dbHost;
        private $dbUsername;
        private $dbPassword;
        private $dbName;
        private $dbConnection;
        private $status;

        function getStatus(){
            return $this->status;
        }

        function test(){
          $this->dbUsername = "root";
          $this->connect();  
        }

        function __construct()
        {
            $this->dbHost = "localhost";
            $this->dbUsername = "";
            $this->dbPassword = "";
            $this->dbName = "giornali_de_leo";
            $this->status = false;
        }

        function connect(){
            $this->dbConnection = new mysqli($this->dbHost,$this->dbUsername,$this->dbPassword,$this->dbName);
            if($this->dbConnection->connect_error){ 
                $this->status = false;
            }else{
                $this->status = true;
            }
        }

        function closeConnection(){
            mysqli_close($this->dbConnection);
        }
    }

?>