<?php 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = require('../data/connection.php');
    
    $title = $_POST['title'] ?? null;
    $author = $_POST['Author'] ?? null;
    $genre = $_POST['Genre'] ?? null;

    $stmt = $conn->prepare('INSERT INTO book (title, author_id, genre_id) VALUE (?,?,?)');
    $stmt->bind_param('sii', $title, $author, $genre);
    $stmt->execute();

    header('location: /books.php');
    die();
}

?>

