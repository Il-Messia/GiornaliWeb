<?php 
        $dbName="giornali_de_leo";
        global $conn;
        $conn = new mysqli($host,$user,$pass,$dbName); 

        if($conn->connect_error){ 
            $result = false;
        }else{
            $result = true;
        }

?>