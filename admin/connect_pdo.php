<?php
    $servername = "localhost";
    $usernameDB = "root";
    $dbname = "phoneshop";
    $passwordDB = "";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $usernameDB, $passwordDB);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
?>