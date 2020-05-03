<?php

$conn = new mysqli('172.18.0.1', 'root', 'root', 'mysqlphp');

if ($conn->connect_errno) {
    die('Failed connection: (' . $conn->connect_errno . ') ' . $conn->connect_errno);
}

$sqlReader = 'CREATE TABLE IF NOT EXISTS reader (
    reader_id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOt NULL,
    email VARCHAR(255) NOT NULL
)';

$sqlAuthor = 'CREATE TABLE IF NOT EXISTS author (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOt NULL
)';

$sqlGenre = 'CREATE TABLE IF NOT EXISTS genre (
    genre_id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOt NULL
)';

$sqlBook = 'CREATE TABLE IF NOT EXISTS `book` (
    book_id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOt NULL,
    author_id INT NOT NULL,
    genre_id INT NOT NULL,
    PRIMARY KEY (book_id),
    FOREIGN KEY (author_id) REFERENCES author(author_id),
    FOREIGN KEY (genre_id) REFERENCES genre(genre_id)
)';

$sqlReaderBook = 'CREATE TABLE IF NOT EXISTS `book_reader` (
    book_reader_id INT NOT NULL AUTO_INCREMENT,
    book_id INT NOT NULL,
    reader_id INT NOT NULL,
    `status` VARCHAR(255) NOT NULL,
    PRIMARY KEY (book_reader_id),
    FOREIGN KEY (book_id) REFERENCES book(book_id),
    FOREIGN KEY (reader_id) REFERENCES reader(reader_id)
)';

$conn->query($sqlReader);
$conn->query($sqlAuthor);
$conn->query($sqlGenre);
$conn->query($sqlBook);
$conn->query($sqlReaderBook);


return $conn;