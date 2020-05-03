<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = require('../data/connection.php');
    
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    
    $stmt = $conn->prepare('INSERT INTO reader (name, email) VALUE (?,?)');
    $stmt->bind_param('ss', $name, $email);
    $stmt->execute();

    header('location: /index.php');
    die();
}