<?php

$conn = require 'data/connection.php';

$result = $conn->query('SELECT b.book_id, b.title, a.name as author, g.name as genre FROM book b 
INNER JOIN author a ON  
	a.author_id = b.author_id 
INNER JOIN genre g ON
	g.genre_id = b.genre_id
');

$books = $result->fetch_all(MYSQLI_ASSOC);

$resultAuthor = $conn->query('SELECT * FROM author');
$authors = $resultAuthor->fetch_all(MYSQLI_ASSOC);

$resultGenre = $conn->query('SELECT * FROM genre');
$genres = $resultGenre->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Books</title>
</head>
<body>
    <div class="container">
        <div class="row mx-md-n5">
            <div class="col">
                <div class="container text-center">
                    <h1 class="display-5">Books</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <nav class="nav justify-content-right nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Reader</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="books.php">Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="authors.php">Authors</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="genres.php">Genres</a>
                    </li>
                </nav>
            </div>
        </div>
        <div class="row content">
            <div class="col">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Genre</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($books as $book) : ?>
                        <tr>
                            <th scope="row"><?php echo $book['book_id']; ?></th>
                            <td>
                                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <?php echo $book['title']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <?php echo $book['author']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <?php echo $book['genre']; ?>
                                </div>
                            </td>
                            <td>
                                <!-- <a href="/crud/editar.php?id=<?php echo $book['book_id']; ?>" title="update book">
                                    <span class="material-icons">update</span>
                                </a> -->
                                <a href="crud/removeBook.php?id=<?php echo $book['book_id']; ?>" title="remove book">
                                    <span class="material-icons">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <form action="crud/addBook.php" method="post">
                        <tr>
                            <th>#</th>
                            <td><input type="text" class="form-control" name="title" placeholder="new book"></td>
                            <td>
                                <select class="form-control" name="Author">
                                    <?php foreach ($authors as $author) : ?>
                                        <option value="<?php echo $author['author_id']; ?>"><?php echo $author['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="Genre">
                                    <?php foreach ($genres as $genre) : ?>
                                        <option value="<?php echo $genre['genre_id']; ?>"><?php echo $genre['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn">
                                    <span class="material-icons">add</span>
                                </button>
                            </td>
                        </tr>
                    </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>