<?php
require_once '../includes/config_session.inc.php';
require_once '../models/class_model.php';
require_once '../includes/dbh.inc.php';

?>

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
    ?>

    <div class="content">
        <?php
        if ($_SESSION['role'] === 'student') { ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Teacher</th>
                    <th>Avg Of Class</th>
                    <th>Number of Students</th>
                    <th>⚙️</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $class): ?>
                <tr>
                    <td>
                        <?= $class['class_name'] ?>
                    </td>
                    <td>
                        <?= $class['class_teacher'] ?>
                    </td>
                    <td>
                        <?= $class['avg_exam_score'] ?>
                    </td>
                    <td>
                        <?= $class['total_students'] ?>
                    </td>
                    <td>
                        <form action="class_operations.php" method="POST">
                            <input type="hidden" name="name" value="<?= $class['class_name'] ?>">
                            <input type="hidden" name="id" value="<?= $class['class_id'] ?>">
                            <input type="hidden" name="teacher_name" value="<?= $class['class_teacher'] ?>">
                            <input type="hidden" name="teacher_username" value="<?= $class['teacher_username'] ?>">
                            <button type="submit" class="btn btn-dark">Edit</button>
                        </form>
                        <form action="../includes/class_operations.inc.php" method="POST">
                            <input type="hidden" name="id" value="<?= $class['class_id'] ?>">
                            <input type="hidden" name="teacher_id" value="<?= $class['teacher_id'] ?>">
                            <button type="submit" class="btn btn-dark">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php } else {
            $classes = get_class_data($pdo);
            ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Teacher</th>
                    <th>Avg Of Class</th>
                    <th>Number of Students</th>
                    <th>⚙️</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $class): ?>
                <tr>
                    <td>
                        <?= $class['class_name'] ?>
                    </td>
                    <td>
                        <?= $class['class_teacher'] ?>
                    </td>
                    <td>
                        <?= $class['avg_exam_score'] ?>
                    </td>
                    <td>
                        <?= $class['total_students'] ?>
                    </td>
                    <td>
                        <form action="class_operations.php" method="POST">
                            <input type="hidden" name="name" value="<?= $class['class_name'] ?>">
                            <input type="hidden" name="id" value="<?= $class['class_id'] ?>">
                            <input type="hidden" name="teacher_name" value="<?= $class['class_teacher'] ?>">
                            <input type="hidden" name="teacher_username" value="<?= $class['teacher_username'] ?>">
                            <button type="submit" class="btn btn-dark">Edit</button>
                        </form>
                        <form action="../includes/class_operations.inc.php" method="POST">
                            <input type="hidden" name="id" value="<?= $class['class_id'] ?>">
                            <input type="hidden" name="teacher_id" value="<?= $class['teacher_id'] ?>">
                            <button type="submit" class="btn btn-dark">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        }
        ?>

        <?php include '../includes/profile_button.inc.php'; ?>
    </div>

    <script>
    let table = new DataTable('#myTable');
    </script>
</body>

</html>