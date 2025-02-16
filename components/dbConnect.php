<?php
    $dbName = "mysql:host=localhost; dbname=skillscape";
    $userName = "root";
    $password = "";

    try {
        $connectDB = new PDO($dbName, $userName, $password);
    } catch (\Throwable $th) {
        echo "Database connection failed";
    }

    // if ($connectDB) { 
    //     echo "Database connected successfully";
    // } 

    function uniqueId(){
        $str = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $rand = array();
        $length = strlen($str) - 1;
        for ($i=0; $i < 20; $i++) { 
            $n = mt_rand(0, $length);
            $rand[] = $str[$n];
        }
        return implode($rand);
    }
?>