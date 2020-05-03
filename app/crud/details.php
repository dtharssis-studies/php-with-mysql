<?php

$conn = require('../data/connection.php');

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare('SELECT b.title, br.status, br.book_id FROM
book b LEFT JOIN book_reader br ON
    br.book_id = b.book_id
WHERE br.reader_id = ?');
    
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

$books = $result->fetch_all(MYSQLI_ASSOC);


$resultBook = $conn->query('SELECT * FROM book');
$booksAvailable = $resultBook->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Class PHP with Mysql</title>
</head>
<body>
    <div class="container">
        <div class="row mx-md-n5">
            <div class="col">
                <div class="container text-center">
                    <h1 class="display-5">Book list</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <nav class="nav justify-content-right nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php">Reader</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/books.php">Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/authors.php">Authors</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/genres.php">Genres</a>
                    </li>

                    <li>
                        <a class="nav-link btn-access active" href="/crud/addReaderBook.php?id=<?php echo $id; ?>">
                            <span class="material-icons">add</span>
                        </a>
                    </li>
                </nav>
            </div>
        </div>

        <div class="row content">
            <div class="col">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($books as $book) : ?>
                        <div class="row">
                            <tr>
                                <th scope="row"><?php echo $book['book_id']; ?></th>
                                <td>
                                    <div class="col"><div class="shadow-lg p-3 mb-5 bg-white rounded"><?php echo $book['title']; ?></div></div>
                                </td>
                                <td>
                                    <div class="col">
                                        <?php if ($book['status'] == "Read"): ?>
                                            <div class="alert-success shadow-lg p-3 mb-5 bg-white rounded">
                                        <?php endif; ?>
                                        <?php if ($book['status'] == "Reading"): ?>
                                            <div class="alert-warning shadow-lg p-3 mb-5 bg-white rounded">
                                        <?php endif; ?>
                                        <?php if ($book['status'] == "Next"): ?>
                                            <div class="alert-info shadow-lg p-3 mb-5 bg-white rounded">
                                        <?php endif; ?>
                                        <?php echo $book['status']; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <!-- <a href="/crud/#?id=<?php echo $id; ?>" title="Remove book reader"> -->
                                        <span class="material-icons">delete</span>
                                    <!-- </a> -->
                                </td>
                            </tr>
                        </div>
                    <?php endforeach; ?>
                    <form action="/crud/addReaderBook.php?id=<?php echo $id; ?>" method="post">
                        <tr>
                            <th>#</th>
                            <td>
                                <select class="form-control" name="Book">
                                    <?php foreach ($booksAvailable as $available) : ?>
                                        <option value="<?php echo $available['book_id']; ?>"><?php echo $available['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                              <select class="form-control" name="Status">
                                    <option value="Next">Next</option>
                                    <option value="Reading">Reading</option>
                                    <option value="Read">Read</option>
                                    <option value="Canceled">Canceled</option>
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