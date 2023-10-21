<?php

include 'dbh.inc.php';
include '../models/student_model.php';
include '../views/student_details_view.php';

include 'config_session.inc.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["name"])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $classId = $_POST['classes'];

        $password = password_hash($pwd, PASSWORD_ARGON2ID);
        try {
            add_student($pdo, $name, $surname, $username, $password);
            $studentId = get_student($pdo, $username)['id'];
            connect_student($pdo, $classId, $studentId);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        header("Location: ../pages/student_operations.php?operation=success");
    } else if (isset($_POST["studentUsername"])) {
        $username = $_POST["studentUsername"];
        $updatedUsername = $_POST["updatedUsername"];
        $updatedName = $_POST["updatedName"];
        $updatedSurname = $_POST["updatedSurname"];

        try {
            updateStudent($pdo, $username, $updatedUsername, $updatedName, $updatedSurname);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: ../pages/student_operations.php?operation=success");
    } else if (isset($_POST['id'])) {
        $studentId = $_POST['id'];

        try {
            deleteStudent($pdo, $studentId);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: ../pages/student_operations.php?operation=success");
    }


    die();
} else if (isset($_GET['studentName'])) {
    $username = $_GET['studentName'];
    try {
        $result = get_one_student_class($pdo, $username);
        $_SESSION['student_result'] = $result;
        header("Location: ../pages/student_operations.php?result=true");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "no get";
}