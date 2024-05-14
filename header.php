<?php
    $tbl = "";
    if (isset($_GET['tbl'])) {
        $tbl = $_GET['tbl'];
    }

    function check($idk) {
        global $tbl;
        if ($tbl == $idk) {
            print("active");
        }
    }
?>

<nav class="navbar navbar-expand bg-white border-bottom px-3">
    <a href="?tbl" class=" text-decoration-none text-reset ">
        <h2>Student Portal</h2>
    </a>
    <div class=" d-inline-flex px-3">
        <a class="px-3 idk <?php check("students") ?>" href="?tbl=students">Students</a>
        <a class="px-3 idk <?php check("courses") ?>" href="?tbl=courses">Courses</a>
        <a class="px-3 idk <?php check("departments") ?>" href="?tbl=departments">Departments</a>
        <a class="px-3 idk <?php check("users") ?>" href="?tbl=users">Users</a>
    </div>
</nav>