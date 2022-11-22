<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/user-model.php');

$emailErr = "";
$passwordErr = "";
$password2Err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userModel = new UserModel();

    $user_email = validateInput($_POST["user_email"]);
    $user_password = validateInput($_POST["user_password"]);
    $user_confirm_password = validateInput($_POST["user_password2"]);

    //check if passwords match
    if ($user_password != $user_confirm_password) {
        $password2Err = "* passwords must match";
        return;
    }

    //check if password is long enough
    if (strlen($user_password) < 8) {
        $passwordErr = "* password less than 8 characters in length";
        return;
    }

    // Remove all illegal characters from email
    $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

    //check if email is valid type
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "* Invalid email format";
        return;
    }

    $result = $userModel->getAllUsersUsingEmail($user_email);

    if ($result->num_rows > 0) {
        $emailErr = "* Email already in the database";
        return;
    }

    $userModel->createNewAccount($user_email, $user_password);
    header("refresh:0; url=/pages/login.php");
}

function validateInput($DataToValidate)
{
    $DataToValidate = trim($DataToValidate);
    $DataToValidate = stripslashes($DataToValidate);
    $DataToValidate = htmlspecialchars($DataToValidate);
    return $DataToValidate;
}
