<?php
include("components.php");
include("globals.php");

$cols = array("Code", "Description");
$modal_content = "";

foreach ($cols as $col) {
    $modal_content .= text_input($col, to_field($col),  to_field($col));
}

modal("Add to Departments", $modal_content, "addModal", "Save", "Cancel");

if (isset($_POST['addModal'])) {

    $values = array();

    foreach ($cols as $key => $value) {
        $values[$value] = $_POST[to_field($value)];
    }

    addToTable($values, "tbl_departments");

    unset($_POST['addModal']);
}

deleteRow("tbl_departments");


if (isset($_POST['editRow'])) {
    $fields = array("code", "description");

    $values = array();
    foreach ($fields as $fieldName) {
        $values[$fieldName] = $_POST[to_field($fieldName)];
    }

    editRow($_POST["editRow"], $values, "tbl_departments");
}
?>

<table class="table table-hover m-0">
    <tr>
        <?php foreach ($cols as $col) {
            echo "<th>$col</th>";
        }
        echo "<th>Actions</th>";
        ?>
    </tr>

    <?php
    global $conn;

    if (!$conn) {
        echo "Something happened";
    }

    addActionModals($modal_content);

    $result = mysqli_query($conn, "SELECT * FROM tbl_departments");

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["code"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        addActionButtons(
            $row[0],
            array(
                "code" => $row["code"],
                "description" => $row["description"],
            )
        );
        echo "</tr>";
    }
    ?>
</table>
