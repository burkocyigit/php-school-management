<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark sidebar" style="width: 280px;">
    <a href="../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Menü</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin')
            include 'sidebar_admin_content.inc.php';
        else if (isset($_SESSION['role']) && $_SESSION['role'] === 'teacher')
            include 'sidebar_teacher_content.inc.php';
        else if (isset($_SESSION['role']) && $_SESSION['role'] === 'student')
            include 'sidebar_student_content.inc.php';

        ?>
    </ul>
    <hr>
</div>