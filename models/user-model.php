<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/private/connection.php');

class UserModel
{

    public function getAllUsersUsingEmail($user_email)
    {
        $conn = connect();

        //check if email in DB
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();

        $conn->close();
        return $result;
    }

    public function getFirstUserUsingEmail($user_email)
    {
        $conn = connect();

        $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? LIMIT 1");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result

        $conn->close();
        return $result;
    }

    public function createNewAccount($user_email, $user_password)
    {
        $conn = connect();
        //hashes password and inserts into database
        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (user_email, user_password) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_email, $hash_password);
        $stmt->execute();

        $conn->close();
    }
}
