<?php
require_once '../includes/config_session.inc.php';
require_once '../models/student_model.php';
require_once '../includes/dbh.inc.php';
require_once '../models/class_model.php';
$students = get_student_class($pdo);
$classes = get_class_data($pdo);
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
    <?php
    include '../includes/sidebar.inc.php';
    require_once '../includes/dbh.inc.php';
    ?>
    <div class="col">
        <?php include '../includes/profile_button.inc.php'; ?>
    </div>


    <div class="content mt-2">
        <table id="myTable" class="display">
            <label for="classes">Filter with class:</label>

            <select name="classes" id="classes">
                <option value="all">All</option>
                <?php foreach ($classes as $class): ?>
                    <option value="<?= $class['class_name'] ?>">
                        <?= $class['class_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Class</th>
                    <th>Avg.</th>
                    <th>⚙️</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td>
                            <?= $student['student_name'] ?>
                        </td>
                        <td>
                            <?= $student['student_surname'] ?>
                        </td>
                        <td>
                            <?= $student['class_name'] ?>
                        </td>
                        <td>
                            <?= $student['average_exam_score'] ?>
                        </td>
                        <td>
                            <form action="student_details.php" method="POST">
                                <input type="hidden" name="username" value="<?= $student['student_username'] ?>">
                                <input type="hidden" name="name" value="<?= $student['student_name'] ?>">
                                <input type="hidden" name="surname" value="<?= $student['student_surname'] ?>">
                                <input type="hidden" name="class" value="<?= $student['class_name'] ?>">
                                <button type="submit" class="btn btn-dark">Details</button>
                            </form>
                            <?php if ($_SESSION['role'] === 'admin') { ?>
                                <form action="student_operations.php" method="POST">
                                    <input type="hidden" name="username" value="<?= $student['student_username'] ?>">
                                    <input type="hidden" name="name" value="<?= $student['student_name'] ?>">
                                    <input type="hidden" name="surname" value="<?= $student['student_surname'] ?>">
                                    <button type="submit" class="btn btn-dark">Edit</button>
                                </form>
                                <form action="../includes/student_operations.inc.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $student['student_id'] ?>">
                                    <button type="submit" class="btn btn-dark">Remove</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>

    <script>
        let table = new DataTable('#myTable');

        var filterDropdown = document.querySelector('#classes');

        filterDropdown.addEventListener('change', function () {
            var selectedCategory = this.value;
            if (selectedCategory != 'all') {
                table.column(2).search(selectedCategory).draw();
            } else {
                table.column(2).search('').draw();
            }
        });
    </script>
</body>

</html>