<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="assets/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        td:first-child,
        th:first-child {
            padding-left: 20px;
        } 


        td:last-child, th:last-child {
            text-align: center;
        } 

        table {
            table-layout: fixed;
        }

        .idk:hover {
            text-decoration: underline;
        }

        .idk {
            text-decoration: none;
        }

        .idk.active {
            color: darkblue;
            text-decoration: underline;
        }

        .addBtn {
            background-color: white;
        }

        .addBtn:hover {
            background-color: whitesmoke;
        }
    </style>
    <title>Document</title>
</head>

<body class="bg-body-tertiary">
    <?php
    include("header.php");

    if (isset($_GET['tbl']) && $_GET['tbl'] != "") {
        include($_GET['tbl'] . ".php");

        $addBtn = <<< HTML
            <div class="addBtn border-secondary-subtle border-bottom text-center" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <h6 class="text-black py-2 m-0">Add +</h6>
            </div>
        HTML;
        echo $addBtn;
    }
    ?>

</body>

<script>
    function deleteRow(id) {
        document.getElementById("row").value = id
    }

    function editRow(id, cols) {
        document.getElementById("editRow").value = id

        cols.forEach((value, key) => {
            setInputValue(key, value)
        })
    }

    function setInputValue(id, value) {
        return document.querySelector("#editModal #"+id).value = value
    }
</script>

</html>