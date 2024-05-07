<?php
include("components.php");
include("globals.php");

$cols = array("Code", "Description", "Department Id");
$modal_content = "";

foreach ($cols as $col) {
    $modal_content .= text_input($col, strtolower($col)."_input",  to_field($col));
}

modal("Add to Courses", $modal_content, $_GET['tbl']);


if (isset($_POST['submit'])) {
    addToTable($cols, "tbl_courses");
}
?>

<table class="table table-hover m-0">
    <tr>
         <?php 
            $headers = array("Code", "Description", "Department");
            foreach ($headers as $col) { echo "<th>$col</th>"; } 
        ?> 
    </tr>

    <?php
    // mysqli_connect(host, username, password, dbname, port, socket) 
    $conn = mysqli_connect("localhost", "root", null, "dbsis", "3306", null);

    if (!$conn) {
        echo "Something happened";
    }

    $result = mysqli_query($conn, "SELECT * FROM tbl_courses inner join tbl_departments on tbl_courses.department_id = tbl_departments.id");  

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[6] . "</td>";
        echo "</tr>";
    }
    ?>
</table>