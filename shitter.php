<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="assets/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div class="addBtn border-secondary-subtle border-bottom text-center" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <h6 class="text-black py-2 m-0">Add +</h6>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Courses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="add_courses.php">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Code" name="courseCode">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Course Description" name="courseDesc">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Department Id</span>
                            <select class="form-select" id="departmentId" name="departmentId">
                                <?php
                                include("globals.php");
                                $departments = mysqli_query($conn, "SELECT * FROM tbl_departments");
                                $options = array();
                                while ($row = mysqli_fetch_array($departments)) {
                                    $options[$row[2]] = "$row[0]";
                                }

                                foreach ($options as $key => $value) {
                                    echo <<<HTML
                                    <option value="$value">$key</option>
                                HTML;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- ADD -->
<?php
    include('config.php');

    if(isset($_POST['submit'])){
        $code = $_POST['courseCode'];
        $desc = $_POST['courseDesc'];
        $deartmentID = $_POST['departmentId'];

        $stmt = $conn->prepare("INSERT INTO tblcourses(Code, Description) VALUES (?,?)");
        $stmt->bind_param("ss",$code,$desc);
        $stmt->execute();

        if($stmt)
            header("Location: course.php");
        else
            echo "ERROR";
    }
?>