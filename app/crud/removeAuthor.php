<?php 

$conn = require('../data/connection.php');

$id = $_GET['id'] ?? null;

$stmt = $conn->prepare('DELETE FROM author WHERE author_id=?');
$stmt->bind_param('i', $id);
$stmt->execute();

header('location: /authors.php');