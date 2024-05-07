<?php
global $conn;
$conn = new mysqli("localhost", "root", "", "dbsis");

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

function addToTable($cols, $tbl) {
    global $conn;

    $fields_query = to_query($cols);

    // get values
    $values = array();
    foreach ($cols as $col) {
        array_push($values, $_POST[to_field($col)]);
    }

    $values_query = to_values($values);

    $query = "INSERT INTO `$tbl` $fields_query VALUES $values_query";

    echo $query;


    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
