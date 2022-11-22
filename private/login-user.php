<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/user-model.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/sanitising.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/validation.php');

$emailErr = "";
$passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userModel = new UserModel();

    $user_email = sanitising\validateInput($_POST["user_email"]);
    $user_password = sanitising\validateInput($_POST["user_password"]);

    //check if password is long enough
    if (!validation\InputIsMinLength($user_password, 8)) {
        $passwordErr = "* password less than 8 characters in length";
    }

    if (!validation\EmailIsAppropriate($user_email)) {
        $emailErr = "* Invalid email format";
    }

    //check if details in the database
    $result = $userModel->getFirstUserUsingEmail($user_email);

    //if query was not successful
    if ($result == false) {
        echo "query not successful";
        return;
    }

    //If no match with email address
    if ($result->num_rows == 0) {
        $emailErr = "* No Account With this Email found";
        return;
    }

    $account = $result->fetch_assoc();

    if (password_verify($user_password, $account["user_password"])) {
        //session started on per page basis
        $_SESSION['username'] = $account['user_email'];
        echo "Correct Password";
        header("refresh:0; url=/");
    } else {
        $passwordErr = "* Incorrect Password";
        return;
    }
}
