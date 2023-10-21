<?php
require_once 'config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="profile-btn">
        <a href="../pages/profile.php">
            <button class="btn-light btn">
                <p>
                    Profile
                    <?php echo $_SESSION['role'] ?>
                </p>
            </button>
        </a>
        <form action="../includes/logout.inc.php">
            <button class="btn btn-light z-3 position-absolute">
                Sign out
            </button>
        </form>
    </div>
</body>

</html>