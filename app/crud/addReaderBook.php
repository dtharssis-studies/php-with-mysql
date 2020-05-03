<?php 

$conn = require('../data/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $book = $_POST['Book'] ?? null;
    $reader = $_GET['id'] ?? null;
    $reader = $_POST['Reader'] ?? $reader;
    $status = $_POST['Status'] ?? null;
    
    $stmt = $conn->prepare('INSERT INTO book_reader (book_id, reader_id, `status`) VALUE (?,?,?)');
    $stmt->bind_param('iis', $book, $reader, $status);
    $stmt->execute();

    header('location: /crud/details.php?id=' . $reader);
    die();
}

$resultBook = $conn->query('SELECT * FROM book');
$books = $resultBook->fetch_all(MYSQLI_ASSOC);

$stmt = $conn->prepare('SELECT * FROM reader WHERE reader_id=?');
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Books</title>
</head>
<body>
    <div class="container">
        <div class="row mx-md-n5">
            <div class="col">
                <div class="container text-center">
                    <h1 class="display-5">Add Book at Reader</h1>
                    <p>Reader: <?php echo $user[0]['name']; ?> </p>
                    <p>ID reader: <?php echo $user[0]['reader_id']; ?> </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <nav class="nav justify-content-right nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php" title="All readers">Reader</a>
                    </li>

                    <li>
                        <a class="nav-link btn-access " href="details.php?id=<?php echo $user[0]['reader_id']; ?>" title="Books <?php echo $user[0]['name'];?>">
                            <span class="material-icons">library_books</span>
                        </a>
                    </li>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="addReaderBook.php" method="post">
                    <div class="form-group">
                        <label for="author">Reader</label>
                        <select class="form-control" name="Reader">
                            <option value="<?php echo $user[0]['reader_id']; ?>"><?php echo $user[0]['name']; ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="author">Book</label>
                        <select class="form-control" name="Book">
                            <?php foreach ($books as $book) : ?>
                                <option value="<?php echo $book['book_id']; ?>"><?php echo $book['title']; ?></option>
                            <?php endforeach; ?>
                            <option value="addBook.php">add book*</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="author">Reader</label>
                        <select class="form-control" name="Status">
                            <option value="Next">Next</option>
                            <option value="Reading">Reading</option>
                            <option value="Read">Read</option>
                            <option value="Canceled">Canceled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block">Save</button>
                </form>
            </div'>
        </div>         
    </div>
</body>
</html>