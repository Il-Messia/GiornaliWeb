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

        function runQuery($query){
            $res = mysqli_query($this->dbConnection, $query);
            return $res;
        }

        /*function setUsername($us){
            switch($us){
                case 1:
                    $this->dbUsername = "admin";
                    $this->dbPassword = "";
                    break;
                case 2:
                    $this->dbUsername = "lettore";
                    $this->dbPassword = "";
                    break;
                case 3:
                    $this->dbUsername = "validatore";
                    $this->dbPassword = "";
                    break;
                case 4:
                    $this->dbUsername = "scrittore";
                    $this->dbPassword = "";
                    break;
                default:
                    $this->dbUsername = "lettore";
                    $this->dbPassword = "";
                    break;
            }
        }*/

        //con password, togliere da commento per utilizzarlo
        function setUsername($us){
            switch($us){
                case 1:
                    $this->dbUsername = "admin";
                    $this->dbPassword = "adminDeLeo_290801";
                    break;
                case 2:
                    $this->dbUsername = "lettore";
                    $this->dbPassword = "";
                    break;
                case 3:
                    $this->dbUsername = "validatore";
                    $this->dbPassword = "validatoreDeLeo_290801";
                    break;
                case 4:
                    $this->dbUsername = "scrittore";
                    $this->dbPassword = "scrittoreDeLeo_290801";
                    break;
                default:
                    $this->dbUsername = "lettore";
                    $this->dbPassword = "";
                    break;
            }
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