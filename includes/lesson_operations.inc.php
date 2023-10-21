<?php

include 'dbh.inc.php';
include '../models/lesson_model.php';
include '../models/teacher_model.php';
include '../views/lesson_details_view.php';
require_once 'config_session.inc.php';
require_once '../models/teacher_model.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["name"])) {
        $name = $_POST['name'];
        $teacherId = $_POST['teacher'];

        try {
            add_lesson($pdo, $teacherId, $name);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        header("Location: ../pages/lesson_operations.php?operation=success");
    } else if (isset($_POST["updatedTeacherUsername"])) {
        $lessonId = $_POST['id'];
        $updatedLessonName = $_POST['updatedLessonName'];
        $updatedTeacherUsername = $_POST['updatedTeacherUsername'];
        $updatedTeacherId = get_teacher($pdo, $updatedTeacherUsername)['id'];

        try {
            updateLesson($pdo, $updatedLessonName, $updatedTeacherId, $lessonId);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: ../pages/lesson_operations.php?operation=success");
    } else if (isset($_POST["delete"])) {
        $lessonId = $_POST['delete'];
        try {
            deleteLesson($pdo, $lessonId);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: ../pages/lessons.php?operation=success");
    }



} else if (isset($_GET['studentName'])) {
    $username = $_GET['studentName'];
    try {
        $result = get_student($pdo, $username);
        $_SESSION['student_result'] = $result;
        header("Location: ../pages/student_operations.php?result=true");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "no get";
}