<?php

declare(strict_types=1);

function get_user(object $pdo, string $username)
{
    $qry = "SELECT * FROM t_users WHERE username = :username";
    $stmt = $pdo->prepare($qry);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}