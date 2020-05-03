<?php

$conn = require 'data/connection.php';

$result = $conn->query('SELECT * FROM author');
$authors = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Reader</title>
</head>
<body>
    <div class="container">
        <div class="row mx-md-n5">
            <div class="col">
                <div class="container text-center">
                    <h1 class="display-5">Readers</h1>
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
                        <a class="nav-link" href="books.php">Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="authors.php">Authors</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="genres.php">Genres</a>
                    </li>
<!-- 
                    <li class="nav-item">
                        <a class="nav-link" href="crud/addAuthor.php">Add author</a>
                    </li> -->
                </nav>
            </div>
        </div>
        <div class="row content">
            <div class="col">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($authors as $author) : ?>
                        <tr>
                            <th scope="row"><?php echo $author['author_id']; ?></th>
                            <td>
                                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <?php echo $author['name']; ?>
                                </div>
                            </td>
                            <td>
                                <!-- <a href="/crud/editar.php?id=<?php echo $author['reader_id']; ?>" title="update author">
                                    <span class="material-icons">update</span>
                                </a> -->
                                <a href="/crud/removeAuthor.php?id=<?php echo $author['author_id']; ?>" title="remove author">
                                    <span class="material-icons">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <form action="crud/addAuthor.php" method="post">
                        <tr>
                            <th>#</th>
                            <td><input type="text" class="form-control" name="name" placeholder="author name"></td>
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