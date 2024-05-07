<?php
include("components.php");
include("globals.php");

$cols = array("Code", "Description");
$modal_content = "";

foreach ($cols as $col) {
    $modal_content .= text_input($col, strtolower($col)."_input",  to_field($col));
}

modal("Add to Departments", $modal_content, $_GET['tbl']);

if (isset($_POST['submit'])) {
    addToTable($cols, "tbl_departments");
}
?>

<table class="table table-hover m-0">
    <tr> <?php foreach ($cols as $col) { echo "<th>$col</th>"; } ?> </tr>

    <?php
    $conn = new mysqli("localhost", "root", "", "dbsis");

    if (!$conn) {
        echo "Something happened";
    }

    $result = mysqli_query($conn, "SELECT * FROM tbl_departments");

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["code"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "</tr>";
    }
    ?>
</table>