<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Shop</title>
    <link rel="stylesheet" href="/css/bookshop.css">
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/pages/about-us.php">About Us</a></li>
                <li>Contact Us</li>
            </ul>
        </nav>
        <nav>
            <ul>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li>Welcome ' . $_SESSION['username'] . '</li>';
                    echo '<li><a href="/pages/logout.php">Log Out</a></li>';
                } else {
                    echo '<li><a href="/pages/login.php">Log In</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <div class="spacer"></div>
    <main>

        <h1>Check out all our books:</h1>

        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/book-controller.php');

        $bookController = new BookController();
        $bookController->invoke();

        ?>

    </main>
    <footer>


    </footer>

</body>

</html>