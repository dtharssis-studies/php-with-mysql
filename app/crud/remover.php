<?php 

$conn = require('../data/connection.php');

$id = $_GET['id'] ?? null;

// var_dump($id);
// die;

$stmt = $conn->prepare('DELETE FROM reader WHERE reader_id=?');
$stmt->bind_param('i', $id);
$stmt->execute();

header('location: /index.php');