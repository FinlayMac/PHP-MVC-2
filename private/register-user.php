<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/private/connection.php');
$conn = connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = validateInput($_POST["user_email"]);
    $user_password = validateInput($_POST["user_password"]);
    $user_confirm_password = validateInput($_POST["user_password2"]);

    //check if passwords match
    if ($user_password != $user_confirm_password) {
        echo "passwords must match";
        return;
    }

    //check if password is long enough
    if (strlen($user_password) < 8) {
        echo "password less than 8 characters in length";
        return;
    }

    // Remove all illegal characters from email
    $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

    //check if email is valid type
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        return;
    }

    //check if email in DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already in the database";
        return;
    }

    //hashes password and inserts into database
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (user_email, user_password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user_email, $hash_password);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    header("refresh:0; url=/pages/login.php");
}

function validateInput($DataToValidate)
{
    $DataToValidate = trim($DataToValidate);
    $DataToValidate = stripslashes($DataToValidate);
    $DataToValidate = htmlspecialchars($DataToValidate);
    return $DataToValidate;
}
