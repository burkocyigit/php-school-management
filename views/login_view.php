<?php

declare(strict_types=1);
function check_login_errors()
{
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION['errors_login'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" role="alert">' .
                $error .
                '</div>';
        }

        unset($_SESSION['errors_login']);
    } else if (isset($_GET["login"]) && $_GET["login"] === "failed") {
        echo '<div class="container alert alert-warning text-center" role="alert" id="success-alert">' .
            'No users found. Try again.' .
            '</div>';
    }
}