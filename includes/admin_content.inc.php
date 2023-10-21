<?php
require_once 'dbh.inc.php';
require_once '../models/student_model.php';
require_once '../models/teacher_model.php';
require_once '../models/class_model.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header">Students</div>
        <div class="card-body text-center">
            <h5 class="card-title">Number of students:</h5>
            <h3 class="card-text">
                <?php echo get_student_number($pdo); ?>
            </h3>
        </div>
    </div>

    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header">Teachers</div>
        <div class="card-body text-center">
            <h5 class="card-title">Number of teachers:</h5>
            <h3 class="card-text">
                <?php echo get_teacher_number($pdo); ?>
            </h3>
        </div>
    </div>

    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header">Classes</div>
        <div class="card-body text-center">
            <h5 class="card-title">Number of classes</h5>
            <h3 class="card-text">
                <?php echo get_class_number($pdo); ?>
            </h3>
        </div>
    </div>

</body>

</html>