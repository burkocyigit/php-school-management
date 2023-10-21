<?php

declare(strict_types=1);

function get_class_data(object $pdo)
{
    $query = "SELECT
    c.id AS class_id,
    c.class_name AS class_name,
    c.class_teacher_id AS teacher_id,
    tu.username AS teacher_username,
    CONCAT(tu.name, ' ', tu.surname) AS class_teacher,
    AVG(te.exam_score) AS avg_exam_score,
    COUNT(cs.student_id) AS total_students
FROM
    t_classes AS c
JOIN
    t_users AS tu ON c.class_teacher_id = tu.id
LEFT JOIN
    t_classes_students AS cs ON c.id = cs.class_id
LEFT JOIN
    t_exams AS te ON c.id = te.class_id
GROUP BY
    c.id, c.class_name, tu.name, tu.surname;
";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function get_all_classes(object $pdo)
{
    $query = "SELECT * FROM t_classes";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


function get_class_number(object $pdo)
{
    $query = "SELECT COUNT(t_classes.id) AS number_of_class FROM t_classes;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['number_of_class'];
}

function get_t_class(object $pdo, string $name)
{
    $query = "SELECT * FROM (t_classes) WHERE class_name=:name";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':name' => $name));


    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function add_class(object $pdo, string $teacherId, string $name)
{
    $query = "INSERT INTO t_classes (class_name, class_teacher_id) VALUES (?, ?);";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array('2023 ' . $name, $teacherId));
}

function updateClass(object $pdo, string $classId, string $newName, string $newTeacherId)
{
    $query = "UPDATE t_class SET class_teacher_id=:newTeacherId, class_name=:newName WHERE id=:classId;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':newTeacherId' => $newTeacherId, ':newName' => $newName, 'classId' => $classId));
}

function deleteClass(object $pdo, string $classId)
{
    $query = "DELETE FROM t_exams WHERE class_id =:class_id;
              DELETE FROM t_classes_students WHERE class_id =:class_id;
              DELETE FROM t_classes WHERE id =:class_id";

    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':class_id' => $classId));
}