<?php
global $conn;
$conn = new mysqli("localhost", "dingle", "dingle", "dbeis");

function to_query(array $arr): string
{
    $q = "(`id`, ";
    foreach ($arr as $k => $v) {
        $q .= "`" . to_field($v) . "`";
        if ($k < count($arr) - 1) {
            $q .= ", ";
        }
    }
    $q .= ")";
    return $q;
}

function to_values(array $arr): string
{
    $q = "(NULL, ";
    foreach ($arr as $k => $v) {
        $q .= "'$v'";
        if ($k < count($arr) - 1) {
            $q .= ", ";
        }
    }
    $q .= ")";
    return $q;
}

function to_field(string $field): string
{
    return str_replace(" ", "_", strtolower($field));
}

function addToTable($cols, $tbl)
{
    global $conn;

    $fields_query = to_query(array_keys($cols));

    // get values
    $values = array();
    foreach (array_keys($cols) as $key) {
        array_push($values, $cols[$key]);
    }

    $values_query = to_values($values);

    $query = "INSERT INTO `$tbl` $fields_query VALUES $values_query";

    print_r($query);

    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

function deleteRow(string $table)
{
    global $conn;
    if (isset($_POST['deleteModal'])) {

        $row = $_POST["row"];

        $smt = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $smt->bind_param("i", $row);
        $smt->execute();

        unset($_POST['deleteModal']);
    }
}

function editRow(string $id, array $values, $tbl)
{
    // UPDATE `tbl_students` SET `last_name` = 'IDd', `middle_name` = 'br', `department_id` = '2' WHERE `tbl_students`.`id` = 27
    global $conn;
    $query = "";

    foreach ($values as $key => $value) {
        $query .= "`$key` = '$value', ";
    }

    $query = rtrim($query, ", ");

    $q = "UPDATE `$tbl` SET $query WHERE `$tbl`.`id` = $id";
    // print_r($q);
    print("Updated row");

    $smt = $conn->prepare("UPDATE `$tbl` SET $query WHERE `$tbl`.`id` = $id");
    mysqli_query($conn, "UPDATE `$tbl` SET $query WHERE `$tbl`.`id` = $id");

    unset($_POST['editRow']);
}

function addActionModals(string $modal_content)
{
    $editModalContent = <<< HTML
        <input type="hidden" name="editRow" id="editRow"/>
        $modal_content
    HTML;

    modal("Edit", $editModalContent, "editModal", "Save", "Cancel");

    $deleteModalContent = <<<HTML
        <p>Are you sure you want to delete this item?</p>
        <input type="hidden" name="row" id="row"/>
    HTML;

    modal("Delete", $deleteModalContent, "deleteModal", "Save", "Cancel");
}

function addActionButtons(int $id, array $values)
{
    $map = "new Map([";

    $i = 1;
    foreach ($values as $key => $value) {
        $map .= "['$key', '$value']";
        if ($i<count($values)) {
            $map .= ",";
        }
        $i++;
    }

    $map .= "])";

    echo <<<HTML
        <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editRow($id, $map)">Edit</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteRow($id)">Delete</button>
        </td>
    HTML;
}
