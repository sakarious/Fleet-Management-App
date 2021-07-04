<?php
  require_once 'core/init.php';
?>

<?php

  $user = new User();

?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Fleet Management System</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo urlFor('/assets/css/bootstrap.css')?>">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>

</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Fleet</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    <?php
                    if($user->isLoggedIn()) {
                    ?>
                    <a class="nav-link" href="logout.php">Log out</a>
                    <a style="color:white; !important" class="nav-link active" aria-current="page" href="#">Hello
                        <?php echo escape($user->data()->name); ?></a>
                    <?php } else { ?>
                    <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="register.php">Register</a>
                    <?php } ?>
                </nav>
            </div>
        </header>