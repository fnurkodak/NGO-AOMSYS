<?php
// index.php

// Define an array of page names and their corresponding filenames
$pages = [
    'Login' => 'login.php',
    'Register' => 'register.php'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">NGO Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php foreach ($pages as $pageName => $filename): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $filename ?>"><?= $pageName ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to the NGO Management System</h1>
        <div class="row justify-content-center mt-4">
            <?php foreach ($pages as $pageName => $filename): ?>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?= $pageName ?></h5>
                            <a href="<?= $filename ?>" class="btn btn-primary">Go to <?= $pageName ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
