<?php

include 'dbh.inc.php';
include '../models/exam_model.php';
require_once 'config_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["add"])) {
        $classId = $_POST['classes'];
        $studentId = $_POST['students'];
        $lessonId = $_POST['lessons'];
        $score = $_POST['score'];
        $date = $_POST['examDate'];
        $a = array($classId, $studentId, $lessonId, $score, $date);
        var_dump($a);


        try {
            add_exam($pdo, $studentId, $lessonId, $classId, $score, $date);
            header("Location: ../pages/exam_operations.php?operation=success");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        die();
    } else if (isset($_POST['update'])) {
        $examId = $_POST['exam_id'];
        $newScore = $_POST['newScore'];

        try {
            update_exam($pdo, $newScore, $examId);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: ../pages/exams.php?operation=success");
        die();
    } else if (isset($_POST['id'])) {
        $examId = $_POST['id'];

        try {
            deleteExam($pdo, $examId);
            header("Location: ../pages/exam_operations.php?operation=success");

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}