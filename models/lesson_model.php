<?php

declare(strict_types=1);

function get_lesson_data(object $pdo)
{
    $query = "SELECT l.id, l.lesson_name, u.username AS username, u.name AS teacher_name FROM t_lessons AS l JOIN t_users AS u ON u.id = l.teacher_user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function get_lesson(object $pdo, string $lessonId)
{
    $query = "SELECT * FROM (t_lessons) WHERE id=:lessonId";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':lessonId' => $lessonId));


    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function add_lesson(object $pdo, string $teacherId, string $name)
{
    $query = "INSERT INTO `t_lessons` (`teacher_user_id`, `lesson_name`) VALUES (?, ?);";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($teacherId, $name));
}

function updateLesson(object $pdo, string $updatedLessonName, string $updatedTeacherId, string $lessonId)
{
    $query = "UPDATE t_lesson SET teacher_user_id=:newTeacherId, name=:newName WHERE id=:lessonId;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':newTeacherId' => $updatedTeacherId, ':newName' => $updatedLessonName, 'lessonId' => $lessonId));
}

function deleteLesson(object $pdo, string $lessonId)
{
    $query = "DELETE FROM t_lessons WHERE id =:lesson_id;";

    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':lesson_id' => $lessonId));
}