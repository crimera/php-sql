<?php
include("components.php");
include("globals.php");

$cols = array("Username", "Accesslevel");
$modal_content = "";

$colsm = array("username", "password", "accesslevel", "user_image");

$modal_content .= text_input("username", "username",  "username");
$modal_content .= text_input("password", to_field("password"), to_field("password"), "", "password");
$modal_content .= select("Access Level", "accesslevel", array("Admin" => "admin", "User" => "user"));
$modal_content .= text_input("User Image", "user_image",  "user_image", "", "file");

modal("Add to Departments", $modal_content, "addModal", "Save", "Cancel");

if (isset($_POST['addModal'])) {

    $values = array();

    move_uploaded_file($_FILES["user_image"]['tmp_name'], "images/" . $_FILES["user_image"]['name']);

    foreach ($colsm as $key => $value) {
        switch ($value) {
            case "user_image":
                $values[$value] = $_FILES["user_image"]['name'];
                break;
            default:
                $values[$value] = $_POST[to_field($value)];
                break;
        }
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
        <?php 
        echo "<th>Image</th>";
        foreach ($cols as $col) {
            echo "<th>$col</th>";
        }
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
        echo "<td>" . img($row["user_image"]) . "</td>";
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