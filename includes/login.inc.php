<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        require_once 'dbh.inc.php';
        require_once '../models/login_model.php';
        require_once '../controller/login_contr.php';
        require_once '../views/login_view.php';

        $errors = [];

        if (is_input_empty($username, $password)) {
            $errors["empty_input"] = "Fill in all fields!";

            header("Location: ../pages/login.php?login=failed");
            die();

        }

        $result = get_user($pdo, $username);

        if (is_password_wrong($password, $result['password'])) {
            $errors["login_incorrect"] = "No users found.";
        }

        require_once 'config_session.inc.php';


        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../pages/login.php?login=failed");
            die();
        }
        $_SESSION["username"] = $username;
        $_SESSION["name"] = $result['name'];
        $_SESSION["role"] = $result['role'];
        $_SESSION["id"] = $result['id'];
        header("Location: ../pages/main.php");
        die();
    } catch (Exception $e) {
        die("Failed : " . $e->getMessage());
    }

}