<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = require('../data/connection.php');
    
    $name = $_POST['name'] ?? null;
    
    $stmt = $conn->prepare('INSERT INTO author (`name`) VALUE (?)');
    $stmt->bind_param('s', $name);
    $stmt->execute();

    header('location: /authors.php');
    die();
}