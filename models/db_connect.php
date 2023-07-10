<?php
    $host = "localhost"; 
    $dbname="phoneshop"; 
    $username = "root"; 
    $password = ""; 
    try {    
    $conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error_message = 'Không thể kết nối đến CSDL';
        $reason = $e->getMessage();
        exit();
    }
?>