<?php 

$conn = require('../data/connection.php');

$id = $_GET['id'] ?? null;

$stmt = $conn->prepare('DELETE FROM book WHERE book_id=?');
$stmt->bind_param('i', $id);
$stmt->execute();

header('location: /books.php');