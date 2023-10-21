<?php

declare(strict_types=1);

function get_teacher_data(object $pdo)
{
    $query = "SELECT u.username, u.id, u.name, u.surname, c.class_name, l.lesson_name FROM t_users AS u JOIN t_classes AS c ON u.id = c.class_teacher_id JOIN t_lessons AS l ON l.teacher_user_id = u.id WHERE u.role = 'teacher';";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function get_all_teachers(object $pdo)
{

    $query = "SELECT * FROM t_users WHERE role='teacher';";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}

function get_teacher(object $pdo, string $username)
{
    $query = "SELECT * FROM (t_users) WHERE username='{$username}' AND role='teacher'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();


    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function get_teacher_students(object $pdo, string $teacherId)
{
    $query = "SELECT
    COUNT(cs.student_id) AS number_of_students
    FROM
        t_classes AS c
    JOIN
        t_classes_students AS cs ON c.id = cs.class_id
    JOIN
        t_users AS u ON c.class_teacher_id = u.id
    WHERE
        u.id =" . $teacherId . ";";
    $stmt = $pdo->prepare($query);
    $stmt->execute();


    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['number_of_students'];
}

function get_teacher_number(object $pdo)
{
    $query = "SELECT COUNT(t_users.id) AS number_of_teachers FROM t_users WHERE role='teacher';";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['number_of_teachers'];
}

function get_teacher_students_average(object $pdo, string $teacherId)
{
    $query = "SELECT
    AVG(te.exam_score) AS average_class_point
    FROM
        t_classes AS c
    JOIN
        t_exams AS te ON c.id = te.class_id
    JOIN
        t_users AS u ON c.class_teacher_id = u.id
    WHERE
        u.id = {$teacherId};";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['average_class_point'];
}

function get_teachers_with_lessons(object $pdo)
{
    $query = "SELECT DISTINCT
    u.name
    FROM
        t_users AS u
    JOIN
        t_lessons AS tl ON u.id = tl.teacher_user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
function add_teacher(object $pdo, string $name, string $surname, string $username, string $pwd)
{
    $query = "INSERT INTO `t_users` (`name`, `surname`, `username`, `password`, `role`, `created_at`) VALUES (?, ?, ?, ?, 'teacher', current_timestamp());";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($name, $surname, $username, $pwd));
}

function updateTeacher(object $pdo, string $username, string $newUsername, string $newName, string $newSurname)
{
    $query = "UPDATE t_users SET username=:newUsername, name=:newName, surname=:newSurname WHERE username=:username;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':newUsername' => $newUsername, ':newName' => $newName, ':newSurname' => $newSurname, ':username' => $username));
}

function updateTeacherPassword(object $pdo, string $username, string $updatedPassword)
{
    $query = "UPDATE t_users SET password=:password WHERE username=:username;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':password' => $updatedPassword, ':username' => $username));
}

function deleteTeacher(object $pdo, string $username)
{
    $query = "UPDATE t_lessons SET teacher_user_id = NULL WHERE teacher_user_id =:teacher_id;;
              UPDATE t_classes SET class_teacher_id = NULL WHERE class_teacher_id =:teacher_id;;
              DELETE FROM t_users WHERE username =:teacher_id;";

    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':teacher_id' => $username));
}