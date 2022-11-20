<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/private/connection.php');
$conn = connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = validateInput($_POST["user_email"]);
    $user_password = validateInput($_POST["user_password"]);

    //check if password is long enough
    if (strlen($user_password) < 8) {
        echo "password less than 8 characters in length";
        header("refresh:2; url=/pages/login.php");
        return;
    }

    //check if email is valid type
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        header("refresh:2; url=/pages/login.php");
        return;
    }

    //check if details in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? LIMIT 1");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();

    $result = $stmt->get_result(); // get the mysqli result

    //if query was not successful
    if ($result == false) {
        echo "query not successful";
        header("refresh:2; url=/pages/login.php");
        return;
    }

    //If no match with email address
    if ($result->num_rows == 0) {
        echo "No Account Found";
        header("refresh:2; url=/pages/login.php");
        return;
    }

    $account = $result->fetch_assoc();

    if (password_verify($user_password, $account["user_password"])) {
        session_start();
        $_SESSION['username'] = $account['user_email'];
        echo "Correct Password";
    } else {
        echo "Incorrect Password";
        header("refresh:2; url=/pages/login.php");
        return;
    }
}

function validateInput($DataToValidate)
{
    $DataToValidate = trim($DataToValidate);
    $DataToValidate = stripslashes($DataToValidate);
    $DataToValidate = htmlspecialchars($DataToValidate);
    return $DataToValidate;
}
