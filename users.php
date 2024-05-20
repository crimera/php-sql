<?php
include("components.php");
include("globals.php");

$cols = array("Username", "Accesslevel");
$modal_content = "";

$colsm = array("username", "password", "accesslevel");
foreach ($colsm as $col) {
    $modal_content .= text_input($col, to_field($col),  to_field($col));
}

modal("Add to Departments", $modal_content, "addModal", "Save", "Cancel");

if (isset($_POST['addModal'])) {

    $values = array();

    $colsm = array("username", "password", "accesslevel");

    foreach ($cols as $key => $value) {
        $values[$value] = $_POST[to_field($value)];
    }

    addToTable($values, "tbl_users");

    unset($_POST['addModal']);
}

if (isset($_POST['editRow'])) {
    $fields = array("username", "password", "accesslevel");

    $values = array();
    foreach ($fields as $fieldName) {
        $values[$fieldName] = $_POST[to_field($fieldName)];
    }

    editRow($_POST["editRow"], $values, "tbl_users");
}

deleteRow("tbl_users");
?>

<table class="table table-hover m-0">
    <tr> 
        <?php foreach ($cols as $col) { echo "<th>$col</th>"; } 
        echo "<th>Actions</th>";
        ?> 
    </tr>

    <?php
    $conn = new mysqli("localhost", "root", "", "dbsis");

    if (!$conn) {
        echo "Something happened";
    }

    $result = mysqli_query($conn, "SELECT * FROM tbl_users");

    addActionModals($modal_content);

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["accesslevel"] . "</td>";
        addActionButtons(
            $row[0],
            array(
                "username" => $row["username"],
                "password" => $row["password"],
                "accesslevel" => $row["accesslevel"],
            )
        );
        echo "</tr>";
    }
    ?>
</table>