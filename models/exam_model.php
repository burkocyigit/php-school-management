<?php

declare(strict_types=1);

function get_exam_data(object $pdo)
{
    $query = "SELECT
    te.id,
    te.exam_date AS exam_date,
    c.class_name AS class_name,
    c.id AS class_id,
    u.name AS student_name,
    te.student_id AS student_id,
    te.lesson_id AS lesson_id,
    u.surname AS student_surname,
    tl.lesson_name AS lesson_name,
    te.exam_score AS score,
    AVG(te.exam_score) AS average_lesson_grades
FROM
    t_exams AS te
JOIN
    t_classes AS c ON te.class_id = c.id
JOIN
    t_users AS u ON te.student_id = u.id
JOIN
    t_lessons AS tl ON te.lesson_id = tl.id
GROUP BY
    te.exam_date,
    c.class_name,
    u.name,
    u.surname,
    tl.lesson_name;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function add_exam(object $pdo, string $student_id, string $lesson_id, string $class_id, string $exam_score, string $exam_date)
{
    $query = "INSERT INTO t_exams (student_id, lesson_id, class_id, exam_score, exam_date) VALUES (?,?,?,?,?);";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($student_id, $lesson_id, $class_id, $exam_score, $exam_date));
}

function update_exam(object $pdo, string $examScore, string $examId)
{
    $query = "UPDATE t_exams
    SET exam_score = :examScore
    WHERE id = :examId;
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':examScore' => $examScore, ':examId' => $examId));


}

function deleteExam(object $pdo, string $examId)
{
    $query = "DELETE FROM t_exams WHERE id =:lesson_id;";

    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':lesson_id' => $examId));
}