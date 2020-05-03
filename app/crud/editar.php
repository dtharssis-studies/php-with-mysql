<?php 

$conn = require('../data/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'] ?? null;
    $name = $_POST['name'] ?? null;
    $reader_id = $_POST['reader_id'] ?? null;

    var_dump($_POST);
    // die;
    
    $stmt = $conn->prepare('UPDATE reader SET email=?, `name`=? WHERE reader_id = ?');
    $stmt->bind_param('ssi', $email, $name, $reader_id);
    $stmt->execute();

    header('location: /index.php');
    die();
}

?>