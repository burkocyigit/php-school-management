<?php
include 'dbh.inc.php';
require_once 'config_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['password'])) {
        $userId = $_POST['id'];
        $pwd = $_POST['password'];
        $pwd2 = $_POST['password2'];

        if ($pwd === $pwd2) {

            $newPassword = password_hash($pwd, PASSWORD_ARGON2ID);

            try {

                $query = "UPDATE t_users ";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array(':newPassword' => $newPassword, ':user_id' => $userId));

            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        } else {
            header("Location: ../pages/profile.php?change=failed");
        }
    }
}