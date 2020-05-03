<?php 

$conn = require('../data/connection.php');

$id = $_GET['id'] ?? null;

$stmt = $conn->prepare('DELETE FROM genre WHERE genre_id=?');
$stmt->bind_param('i', $id);
$stmt->execute();

header('location: /genres.php');