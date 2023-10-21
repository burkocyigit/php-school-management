<?php

include 'dbh.inc.php';
include '../models/class_model.php';
include '../views/class_details_view.php';
require_once 'config_session.inc.php';
require_once '../models/teacher_model.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["newName"])) {
        $name = $_POST['newName'];
        $teacherName = $_POST['teacher_username'];

        try {
            add_class($pdo, get_teacher($pdo, $teacherName)['id'], $name);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        header("Location: ../pages/class_operations.php?operation=success");

    } else if (isset($_POST["updated_class_name"])) {
        $classId = $_POST['class_id'];
        $updatedClassName = $_POST['updated_class_name'];
        $teacherUsername = $_POST['teacher_username'];
        $updatedTeacherId = get_teacher($pdo, $teacherUsername)['id'];

        try {
            updateClass($pdo, $classId, $updatedClassName, $updatedTeacherId);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: ../pages/class_operations.php?operation=success");

    } else if (isset($_POST["id"])) {
        $classId = $_POST['id'];
        $teacherId = $_POST['teacher_id'];

        try {
            deleteClass($pdo, $classId);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: ../pages/class_operations.php?operation=success");

    }
    die();
}