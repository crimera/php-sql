<?php
include("components.php");
include("globals.php");

$cols = array("Code", "Description", "Department Id");
$modal_content = "";

foreach ($cols as $col) {
    switch ($col) {
        case 'Department Id':
            $courses = mysqli_query($conn, "SELECT * FROM tbl_departments");

            $options = array();
            while ($row = mysqli_fetch_array($courses)) {
                $options[$row[2]] = "$row[0]";
            }

            $modal_content .= select($col, to_field($col), $options);
            break;

        default:
            $modal_content .= text_input($col, to_field($col),  to_field($col));
            break;
    }
}

modal("Add to Courses", $modal_content, "addModal", "Save", "Cancel");

if (isset($_POST['addModal'])) {
    $values = array();

    foreach ($cols as $key => $value) {
        $values[$value] = $_POST[to_field($value)];
    }

    addToTable($values, "tbl_courses");

    unset($_POST['addModal']);
}

deleteRow("tbl_courses");

if (isset($_POST['editRow'])) {
    $fields = array("Code", "Description", "Department Id");

    $values = array();
    foreach ($fields as $fieldName) {
        $values[to_field($fieldName)] = $_POST[to_field($fieldName)];
    }

    editRow($_POST["editRow"], $values, "tbl_courses");
}
?>

<table class="table table-hover m-0">
    <tr>
        <?php
        foreach ($cols as $col) {
            echo "<th>$col</th>";
        }
        echo "<th>Actions</th>";
        ?>
    </tr>

    <?php
    // mysqli_connect(host, username, password, dbname, port, socket) 
    $conn = mysqli_connect("localhost", "root", null, "dbsis", "3306", null);

    if (!$conn) {
        echo "Something happened";
    }

    $result = mysqli_query($conn, "SELECT * FROM tbl_courses inner join tbl_departments on tbl_courses.department_id = tbl_departments.id");

    addActionModals($modal_content);

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[6] . "</td>";
        addActionButtons(
            $row[0],
            array(
                "code" => $row[1],
                "description" => $row[2],
                "department_id" => $row["department_id"],
            )
        );
        echo "</tr>";
    }
    ?>
</table>