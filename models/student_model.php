<?php

declare(strict_types=1);

function get_student_data(object $pdo)
{
    $query = "SELECT * FROM t_users WHERE role='student';";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function get_student_number(object $pdo)
{
    $query = "SELECT COUNT(t_users.id) AS number_of_students FROM t_users WHERE role='student';";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['number_of_students'];
}

function get_student(object $pdo, string $username)
{
    $query = "SELECT * FROM (t_users) WHERE username='{$username}' AND role='student'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function get_student_average(object $pdo, string $studentId)
{
    $query = "";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function get_one_student_class(object $pdo, string $username)
{
    $query = "SELECT u.name AS student_name, u.username AS student_username, u.surname AS student_surname, c.class_name AS class_name FROM t_users AS u JOIN t_classes_students AS cs ON u.id = cs.student_id JOIN t_classes AS c ON cs.class_id = c.id WHERE u.role = 'student' AND u.username =:username ;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':username' => $username));

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function get_student_class(object $pdo)
{
    $query = "SELECT
    u.id AS student_id,
    u.name AS student_name,
    u.username AS student_username,
    u.surname AS student_surname,
    c.class_name AS class_name,
    AVG(te.exam_score) AS average_exam_score
FROM
    t_users AS u
JOIN
    t_classes_students AS cs ON u.id = cs.student_id
JOIN
    t_classes AS c ON cs.class_id = c.id
LEFT JOIN
    t_exams AS te ON u.id = te.student_id AND c.id = te.class_id
WHERE
    u.role = 'student'
GROUP BY
    u.id, u.name, u.username, u.surname, c.class_name;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function get_student_exams(object $pdo, string $username)
{
    $query = "SELECT
    u.username AS student_username,
    te.exam_date,
    te.exam_score,
    tl.lesson_name,
    AVG(te.exam_score) OVER(PARTITION BY te.lesson_id) AS lesson_average
FROM
    t_users AS u
JOIN
    t_exams AS te ON u.id = te.student_id
JOIN
    t_lessons AS tl ON te.lesson_id = tl.id
WHERE
    u.username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':username' => $username));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function add_student(object $pdo, string $name, string $surname, string $username, string $pwd)
{
    $query = "INSERT INTO `t_users` (`name`, `surname`, `username`, `password`, `role`, `created_at`) VALUES (?, ?, ?, ?, 'student', current_timestamp());";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($name, $surname, $username, $pwd));
}

function connect_student(object $pdo, string $classId, string $studentId)
{
    $qry = "INSERT INTO t_classes_students (student_id, class_id) VALUES (?, ?)";
    $statement = $pdo->prepare($qry);
    $statement->execute(array($studentId, $classId));
}

function updateStudent(object $pdo, string $username, string $newUsername, string $newName, string $newSurname)
{
    $query = "UPDATE t_users SET username=:newUsername, name=:newName, surname=:newSurname WHERE username=:username;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':newUsername' => $newUsername, ':newName' => $newName, ':newSurname' => $newSurname, ':username' => $username));
}

function deleteStudent(object $pdo, string $studentId)
{
    $query = "DELETE FROM t_classes_students WHERE student_id =:student_id;
              DELETE FROM t_exams WHERE student_id =:student_id;";

    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':student_id' => $studentId));
}