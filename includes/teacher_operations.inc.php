<?php

include 'dbh.inc.php';
include '../models/teacher_model.php';
include '../views/teacher_details_view.php';
require_once 'config_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["name"])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $pwd = $_POST['password'];

        $password = password_hash($pwd, PASSWORD_ARGON2ID);
        try {
            add_teacher($pdo, $name, $surname, $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        header("Location: ../pages/teacher_operations.php?operation=success");
    } else if (isset($_POST["teacherUsername"])) {
        $username = $_POST["teacherUsername"];
        $updatedUsername = $_POST["updatedUsername"];
        $updatedName = $_POST["updatedName"];
        $updatedSurname = $_POST["updatedSurname"];
        if (isset($_POST['updatedPassword'])) {
            $updatedPassword = $_POST['updatedPassword'];
            try {
                $password = password_hash($updatedPassword, PASSWORD_ARGON2ID);
                updateTeacherPassword($pdo, $username, $password);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        try {
            updateTeacher($pdo, $username, $updatedUsername, $updatedName, $updatedSurname);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: ../pages/teacher_operations.php?operation=success");
    } else if (isset($_POST['delete'])) {
        $usernameToDelete = $_POST['delete'];
        deleteTeacher($pdo, $usernameToDelete);
    }
    header("Location: ../pages/teacher_operations.php?operation=success");
    die();
} else if (isset($_GET['teacherName'])) {
    $username = $_GET['teacherName'];
    try {
        $result = get_teacher($pdo, $username);
        if ($result) {
            $_SESSION['teacher_result'] = $result;
            header("Location: ../pages/teacher_operations.php?result=true");
        } else {
            header("Location: ../pages/teacher_operations.php?result=false");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "no get";
}