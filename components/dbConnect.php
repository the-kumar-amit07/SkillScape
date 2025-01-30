<?php
    $dbName = "mysql:host=localhost; dbname=skillscape";
    $userName = "root";
    $password = "";

    $connectDB = new PDO($dbName, $userName, $password);

    if (!$connectDB) { 
        echo "Database connected successfully";
    } else {
        echo "Database connection failed";
    }

    function uniqueId(){
        $str = "1234567890abcdefghijklmnopqrstuvwxyz";
        $rand = array();
        $length = strlen($str) - 1;
        for ($i=0; $i < 20; $i++) { 
            $n = mt_rand(0, $length);
            $rand[] = $str[$n];
        }
        return implode($rand);
    }
?>