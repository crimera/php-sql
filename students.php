<?php
include("components.php");
include("globals.php");

$cols = array("Student no", "First name", "Last name", "Middle Name", "Course Id", "Department Id");
$modal_content = "";

foreach ($cols as $col) {
    switch ($col) {
        case 'Course Id':
            $courses = mysqli_query($conn, "SELECT * FROM tbl_courses inner join tbl_departments on tbl_courses.department_id = tbl_departments.id");

            $options = array();
            while ($row = mysqli_fetch_array($courses)) {
                $options[$row[2]] = "$row[0]:$row[4]";
            }

            $modal_content .= select($col, to_field($col), $options);
            break;

        case 'Department Id':
            break;

        default:
            $modal_content .= text_input($col, strtolower($col) . "_input",  to_field($col));
            break;
    }
}

$tbl = $_GET['tbl'];

modal("Add to Students", $modal_content, "addModal", "Save", "Cancel");

if (isset($_POST['addModal'])) {
    $values = array();

    $courseId = $_POST[to_field("Course Id")];
    $_POST[to_field("Course Id")] = explode(":", $courseId)[0];
    $_POST[to_field("Department Id")] = explode(":", $courseId)[1];

    foreach ($cols as $key => $value) {
        $values[$value] = $_POST[to_field($value)];
    }

    addToTable($values, "tbl_students");

    unset($_POST['addModal']);
}

deleteRow("tbl_students");
?>

<table class="table table-hover m-0 ">
    <tr>
        <?php
        foreach ($cols as $col) {
            echo "<th>$col</th>";
        }
        // Buttons
        echo "<th></th>";
        ?>
    </tr>

    <?php

    if (!$conn) {
        echo "Something happened";
    }

    $result = mysqli_query($conn, "SELECT * FROM tbl_students INNER JOIN tbl_courses ON tbl_students.course_id = tbl_courses.id INNER JOIN tbl_departments ON tbl_students.department_id = tbl_departments.id");

    addActionModals($modal_content);

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["student_no"] . "</td>";
        echo "<td>" . $row["first_name"] . "</td>";
        echo "<td>" . $row["last_name"] . "</td>";
        echo "<td>" . $row["middle_name"] . "</td>";
        echo "<td>" . $row[9] . "</td>";
        echo "<td>" . $row[13] . "</td>";
        addActionButtons($row[0]);
        echo "</tr>";
    }
    ?>
</table>