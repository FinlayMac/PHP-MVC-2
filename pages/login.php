<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Shop</title>
    <link rel="stylesheet" href="/css/bookshop.css">
    <script defer src="/scripts/bouncer.min.js"></script>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="/index.php">Home Page</a></li>
                <li>About Us</li>
                <li>Contact Us</li>
            </ul>
        </nav>
        <nav>
            <ul>
                <?php
                session_start();
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

        <h1>Please enter your log in details</h1>


        <form action="/private/login_user.php" method="post">

            <a href="register.php">Register An Account Here</a> <br><br>
            <label for="username">Username</label><br>
            <input id="username" name="user_email" type="email" placeholder="eye@read.books" minlength="3" required><br><br>

            <label for="password">Password</label><br>
            <input id="password" name="user_password" type="password" placeholder="**********" minlength="8" required><br><br>

            <input type="submit" value="Log In">

        </form>

        <?php
        // include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/book-controller.php");

        // $bookController = new BookController();
        // $bookController->invoke();

        ?>

    </main>
    <footer>


    </footer>

</body>


<script>
    document.addEventListener("DOMContentLoaded", function() {


        var validate = new Bouncer('form');
    });
</script>


</html>