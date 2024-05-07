<?php
include("components.php");
include("globals.php");

$cols = array("Student no", "First name", "Last name", "Middle Name", "Course Id", "Department Id");
$modal_content = "";

foreach ($cols as $col) {
    // if ($col == "Department Id") {
    //     $modal_content .= 
    //     continue;  
    // }
    $modal_content .= text_input($col, strtolower($col) . "_input",  to_field($col));
}

$tbl = $_GET['tbl'];

modal("Add to Students", $modal_content, $tbl);

if (isset($_POST['submit'])) {
    addToTable($cols, "tbl_students");
}
?>

<table class="table table-hover m-0 ">
    <tr>
        <?php
        foreach ($cols as $col) {
            echo "<th>$col</th>";
        }
        ?>
    </tr>

    <?php

    if (!$conn) {
        echo "Something happened";
    }

    $result = mysqli_query($conn, "SELECT * FROM tbl_students INNER JOIN tbl_courses ON tbl_students.course_id = tbl_courses.id INNER JOIN tbl_departments ON tbl_students.department_id = tbl_departments.id");

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["student_no"] . "</td>";
        echo "<td>" . $row["first_name"] . "</td>";
        echo "<td>" . $row["last_name"] . "</td>";
        echo "<td>" . $row["middle_name"] . "</td>";
        echo "<td>" . $row[9] . "</td>";
        echo "<td>" . $row[13] . "</td>";
        echo "</tr>";
    }
    ?>
</table>