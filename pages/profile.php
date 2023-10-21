<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

</head>

<body>
    <?php include '../includes/sidebar.inc.php';
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';
    ?>

    <?php include '../includes/sidebar.inc.php' ?>

    <div class="content">
        <h3>Name :
            <?php echo $_SESSION['name'] ?>
        </h3>
        <h3>Username :
            <?php echo $_SESSION['username'] ?>
        </h3>
        <h3>Role :
            <?php echo $_SESSION['role'] ?>
        </h3>
        <hr>
        <h2>Change Password</h2>
        <form action="../includes/profile.inc.php" class="form-group" method="post">
            <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
            <label for="pwd">New Password</label>
            <input type="password" name="password">
            <label for="pwd_2">Confirm New Password</label>
            <input type="password" name="password2">
            <button class="btn btn-primary">Change Password</button>
        </form>
        <?php
        if (isset($_GET['change'])) {
            $respond = $_GET['change'];

            switch ($respond) {
                case 'failed':
                    echo '<div class="container alert alert-warning text-center" role="alert" id="success-alert">' .
                        'Failed.' .
                        '</div>';
                    break;
                case 'success':
                    echo '<div class="container alert alert-success text-center" role="alert" id="success-alert">' .
                        'Success.' .
                        '</div>';
                    break;
            }
        }
        ?>
    </div>
</body>

</html>