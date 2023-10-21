<?php
require_once '../includes/config_session.inc.php';
require_once '../models/student_model.php';
require_once '../includes/dbh.inc.php';
require_once '../models/teacher_model.php';
require_once '../models/lesson_model.php';
require_once '../models/class_model.php';
$teachers = get_teacher_data($pdo);
$classes = get_all_classes($pdo);
$lessons = get_lesson_data($pdo);
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
        <table id="myTable" class="display">

            <label for="class">Filter with class:</label>
            <select name="classes" id="classes" class="d-block">
                <option value="all">All</option>
                <?php foreach ($classes as $class): ?>
                    <option value="<?= $class['class_name'] ?>">
                        <?= $class['class_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for=" lesson">Filter with lesson:</label>
            <select name="lessons" id="lessons" class="d-block">
                <option value=" all">All</option>
                <?php foreach ($lessons as $lesson): ?>
                    <option value="<?= $lesson['lesson_name'] ?>">
                        <?= $lesson['lesson_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Class</th>
                    <th>Lesson</th>
                    <th>⚙️</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $teacher): ?>
                    <tr>
                        <td>
                            <?= $teacher['name'] ?>
                        </td>
                        <td>
                            <?= $teacher['surname'] ?>
                        </td>
                        <td>
                            <?= $teacher['class_name'] ?>
                        </td>
                        <td>
                            <?= $teacher['lesson_name'] ?>
                        </td>
                        <td>
                            <form action="teacher_operations.php" method="POST">
                                <input type="hidden" name="username" value="<?= $teacher['username'] ?>">
                                <input type="hidden" name="name" value="<?= $teacher['name'] ?>">
                                <input type="hidden" name="surname" value="<?= $teacher['surname'] ?>">
                                <button type="submit" class="btn btn-dark">Edit</button>
                            </form>
                            <form action="../includes/teacher_operations.inc.php" method="POST">
                                <input type="hidden" name="delete" value="<?= $teacher['id'] ?>">
                                <button type="submit" class="btn btn-dark">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php include '../includes/profile_button.inc.php'; ?>
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
                table.column(3).search('').draw();
            }
        });

        var filterDropdown = document.querySelector('#lessons');

        filterDropdown.addEventListener('change', function () {
            var selectedCategory = this.value;
            if (selectedCategory != 'all') {
                table.column(3).search(selectedCategory).draw();
            } else {
                table.column(3).search('').draw();
            }
        });
    </script>
</body>

</html>