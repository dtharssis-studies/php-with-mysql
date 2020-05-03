<?php

$conn = require 'data/connection.php';

$result = $conn->query('SELECT * FROM reader');
$users = $result->fetch_all(MYSQLI_ASSOC);

$books;

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
                        <a class="nav-link active" href="index.php">Reader</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="books.php">Books</a>
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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/crud/editar.php" method="post">
                                        <div class="form-group reader_id">
                                            <input type="hidden" class="form-control" name="reader_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Name:</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="form-group email">
                                            <label for="message-text" class="col-form-label">Email:</label>
                                            <input type="email" class="form-control" name="email" placeholder="New email">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                        <tr>
                            <th scope="row"><?php echo $user['reader_id']; ?></th>
                            <td>
                                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <?php echo $user['name']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                    <?php echo $user['email']; ?>
                                </div>
                            </td>
                            <td>
                                <a href="crud/details.php?id=<?php echo $user['reader_id']; ?>" title="Books">
                                    <span class="material-icons">library_books</span>
                                </a>
                                <a href="#" title="update reader" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $user['reader_id']; ?>" data-email="<?php echo $user['email']; ?>" data-whatever="<?php echo $user['name']; ?>">
                                    <span class="material-icons">update</span>
                                </a>
                                <a href="/crud/remover.php?id=<?php echo $user['reader_id']; ?>" title="remove reader">
                                    <span class="material-icons">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <form action="crud/add.php" method="post">
                        <tr>
                            <th>#</th>
                            <td><input type="text" class="form-control" name="name" placeholder="name "></td>
                            <td><input type="email" class="form-control" name="email" placeholder="name@email.com"></td>
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
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var email = button.data('email')
            var reader_id = button.data('id')
            var modal = $(this)

            modal.find('.modal-title').text('Update ' + recipient)
            modal.find('input[name="name"]').val(recipient)
            modal.find('.email input[name="email"]').val(email)
            modal.find('.reader_id input[name="reader_id"]').val(reader_id)
       })
       
    </script>
</body>
</html>