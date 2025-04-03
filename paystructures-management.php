<?php
require_once "config.php";
include "session_checker_admin.php";
if (isset($_POST['txtpaystructureemployee_id'])) {
    $employee_id = $_POST['txtpaystructureemployee_id'];
} else {
    $employee_id = $_SESSION['txtpaystructureemployee_id'];
}
//echo ($_SESSION['txtpaystructureemployee_id']);
$sql = "SELECT 
    tblpaystructures.paystructure_id,
    tblpaystructures.paystructure_value,
    tblemployees.employee_id,
    tblemployees.name,
    tblemployees.position,
    tblemployees.branch,
    tblpayheads.payhead_id,
    tblpayheads.payhead_name,
    tblpayheads.payhead_desc,
    tblpayheads.payhead_type
FROM tblpaystructures
INNER JOIN tblemployees ON tblpaystructures.employee_id = tblemployees.employee_id
INNER JOIN tblpayheads ON tblpaystructures.payhead_id = tblpayheads.payhead_id WHERE tblemployees.employee_id = '" . $employee_id . "'";
$result = mysqli_query($link, $sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accounts Management</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <!-- Datatables CSS-->
    <link href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" />
    <style>
        /*Table*/
        @media screen and (min-width: 768px) {

            /* Hide horizontal scrollbar for web view */
            .table-responsive {
                overflow-x: hidden;
            }
        }

        @media screen and (max-width: 767px) {

            /* Allow horizontal scrolling for mobile view */
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <div class="main-container d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-light text-dark" id="side_nav">
            <div class="header-box bg-white px-2 pt-3 pb-3 d-flex align-items-center" style="height:65px">
                <img src="hand-coins.png" height="25" class="ms-3"><span
                    class="text-dark fs-4 fw-bold ms-1 me-4">Payroll</span>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-dark ms-5"><i
                        class="fal fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2 text-dark bg-light mt-1">
                <li class=""><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block text-dark">
                        <i class="fal fa-home"></i> Dashboard
                    </a></li>
                <li class=""><a href="employees-management.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-users">
                        </i>
                        Employees</a></li>
                <li class=""><a href="leave-management-admin.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-arrow-circle-left">
                        </i> Leave</a></li>
                <li class=""><a href="attendance-management-admin.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-clock"></i>
                        Attendance</a></li>
                <li class=""><a href="accounts-management.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-users"></i>
                        Accounts</a></li>
                <li class=""><a href="payheads-management.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-minus"></i>
                        Pay Heads</a></li>
                <li class=""><a href="branches-management.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-building"></i>
                        Branches</a></li>
                <li class=""><a href="payslips-management-admin.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-file"></i>
                        Payslips</a></li>
                <li class=""><a href="logout.php" class="text-decoration-none px-3 py-2 d-block text-dark"><i
                            class="fal fa-sign-out text-dark"></i>
                        Logout</a></li>
            </ul>
        </div>
        <div class="content bg-secondary bg-opacity-10">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-md navbar-white bg-white" style="height:65px">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span
                                class="rounded px-2 py-0 text-black fw-bold">Payroll</span></a>
                    </div>
                </div>
            </nav>
            <!--Notification-->
            <?php
            if (isset($_SESSION['executionStatus'])) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . $_SESSION['executionStatus'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                unset($_SESSION['executionStatus']);
            }
            ?>

            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="paystructure-add.php" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModalLabel">Add New Payhead for Employee</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Fill up this form and submit to add a new payhead for the employee.</p>
                                <?php
                                echo ("<input type='text' id='txtemployee_id' name='txtemployee_id'
                                        class='form-control' value='" . $employee_id . "' hidden>")
                                    ?>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>

                                            <td><label class="fw-bold">Payhead Name:</label></td>
                                            <td>
                                                <select name="cmbpayhead_name" id="cmbpayhead_name" class="form-control"
                                                    required onchange="fetchPayheadDetails()">
                                                    <option value="">--Select Payhead--</option>
                                                    <?php
                                                    $addpayheadsql = "
                                                    SELECT tblpayheads.payhead_id, tblpayheads.payhead_name
                                                    FROM tblpayheads
                                                    WHERE tblpayheads.payhead_id NOT IN (
                                                        SELECT tblpaystructures.payhead_id 
                                                        FROM tblpaystructures 
                                                        WHERE tblpaystructures.employee_id = '$employee_id'
                                                    );";

                                                    $payheadresult = mysqli_query($link, $addpayheadsql);
                                                    while ($row = mysqli_fetch_assoc($payheadresult)) {
                                                        echo "<option value='" . htmlspecialchars($row['payhead_id']) . "'>" . htmlspecialchars($row['payhead_name']) . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Description:</label></td>
                                            <td><input type="text" id="txtpayhead_desc" name="txtpayhead_desc"
                                                    class="form-control" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Type:</label></td>
                                            <td><input type="text" id="txtpayhead_type" name="txtpayhead_type"
                                                    class="form-control" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Value:</label></td>
                                            <td><input type="number" name="txtpaystructure_value" class="form-control"
                                                    required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="btnAdd" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="paystructure-edit.php" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">Edit Pay Structure Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Fill up this form and submit to edit pay structure details.</p>
                                <?php
                                echo ("<input type='text' id='edittxtemployeeid' name='edittxtemployeeid'
                                 class='form-control' value='" . $employee_id . "' hidden>")
                                    ?>

                                ?>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><label class="fw-bold">Pay Structure ID:</label></td>
                                            <td><input type="text" name="edittxtpaystructureid"
                                                    id="edittxtpaystructureid" class="form-control" required readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Pay Head ID:</label></td>
                                            <td>
                                                <input type="text" name="edittxtpayheadid" id="edittxtpayheadid"
                                                    class="form-control" required readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Pay Head Name:</label></td>
                                            <td>
                                                <input type="text" name="edittxtpayheadname" id="edittxtpayheadname"
                                                    class="form-control" required readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Pay Head Description:</label></td>
                                            <td>
                                                <input type="text" name="edittxtpayheaddesc" id="edittxtpayheaddesc"
                                                    class="form-control" required readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Pay Structure Value:</label></td>
                                            <td>
                                                <input type="text" name="edittxtpaystructurevalue"
                                                    id="edittxtpaystructurevalue" class="form-control" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="btnEdit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <form action="paystructure-delete.php" method="POST">
                <div class="modal" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Employee's Payhead Confirmation</h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this employee's payhead?</p>
                                <input type="hidden" name="deletetxtpaystructureid" id="deletetxtpaystructureid"
                                    readonly><br>
                                <?php echo ("<input type='text' id='deletetxtemployeeid' name='deletetxtemployeeid'
                                        class='form-control' value='" . $employee_id . "' hidden>")
                                    ?>

                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnDelete">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex align-items-center  justify-content-between me-4 ms-4 mt-4">
                <span class="fs-5 fw-bold">Pay Structures Management</span>
                <button type="button" class="btn btn-primary btn-sm fs-6 bg-dark text-white" data-bs-toggle="modal"
                    data-bs-target="#addModal">Add New Pay Head
                </button>
            </div>
            <!-- Table -->
            <div class="table-responsive m-3">
                <table class="table table-bordered table-striped text-center p-1" id="table">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Structure_ID</th>
                            <th>Payhead_ID</th>
                            <th>Payhead_Name</th>
                            <th>Payhead_Desc</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['payhead_id'] == 1) {
                                echo "<tr>";
                                echo "<td>" . $row['paystructure_id'] . "</td>";
                                echo "<td>" . $row['payhead_id'] . "</td>";
                                echo "<td>" . $row['payhead_name'] . "</td>";
                                echo "<td>" . $row['payhead_desc'] . "</td>";
                                echo "<td>" . $row['paystructure_value'] . "</td>";
                                echo "<td>";
                                echo "<a class='btn btn-small editbtn'><img src='editicon.png' alt='Edit' height='15' width='15'></a>";
                                echo "</td>";
                                echo "</tr>";
                            } elseif ($row['payhead_id'] == 2) {
                                echo "<tr>";
                                echo "<td>" . $row['paystructure_id'] . "</td>";
                                echo "<td>" . $row['payhead_id'] . "</td>";
                                echo "<td>" . $row['payhead_name'] . "</td>";
                                echo "<td>" . $row['payhead_desc'] . "</td>";
                                echo "<td>" . $row['paystructure_value'] . "</td>";
                                echo "<td>";
                                echo "</td>";
                                echo "</tr>";
                            } else {
                                echo "<tr>";
                                echo "<td>" . $row['paystructure_id'] . "</td>";
                                echo "<td>" . $row['payhead_id'] . "</td>";
                                echo "<td>" . $row['payhead_name'] . "</td>";
                                echo "<td>" . $row['payhead_desc'] . "</td>";
                                echo "<td>" . $row['paystructure_value'] . "</td>";
                                echo "<td>";
                                echo "<a class='btn btn-small editbtn'><img src='editicon.png' alt='Edit' height='15' width='15'></a>";
                                echo "<a class='btn btn-small deletebtn'><img src='deleteicon.png' alt='Edit' height='17' width='15'></a>";
                                echo "</td>";
                                echo "</tr>";
                            }

                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Datatables Scripts-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $("#table").DataTable();

            // Event delegation for edit button
            $(document).on("click", ".editbtn", function () {
                // Find the closest row of the clicked button
                const $row = $(this).closest("tr");

                // Extract data from the row
                const edittxtpaystructureid = $row.find("td:eq(0)").text();
                const edittxtpayheadid = $row.find("td:eq(1)").text();
                const edittxtpayheadname = $row.find("td:eq(2)").text();
                const edittxtpayheaddesc = $row.find("td:eq(3)").text();
                const edittxtpaystructurevalue = $row.find("td:eq(4)").text();

                // Populate the modal fields
                $("#edittxtpaystructureid").val(edittxtpaystructureid);
                $("#edittxtpayheadid").val(edittxtpayheadid);
                $("#edittxtpayheadname").val(edittxtpayheadname);
                $("#edittxtpayheaddesc").val(edittxtpayheaddesc);
                $("#edittxtpaystructurevalue").val(edittxtpaystructurevalue);

                // Show the modal
                $("#editModal").modal("show");
            });

            // Event delegation for delete button
            $(document).on("click", ".deletebtn", function () {
                // Find the closest row of the clicked button
                const $row = $(this).closest("tr");

                // Extract the employee ID from the row
                const deletepaystructureid = $row.find("td:eq(0)").text();

                // Populate the modal field
                $("#deletetxtpaystructureid").val(deletepaystructureid);

                // Show the modal
                $("#deleteModal").modal("show");
            });
        });

    </script>
    </script>
    <script defer src="sidebar.js">
    </script>
    <script>
        function fetchPayheadDetails() {
            var payheadId = document.getElementById("cmbpayhead_name").value;

            if (payheadId !== "") {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "fetch-payhead.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            document.getElementById("txtpayhead_desc").value = response.description;
                            document.getElementById("txtpayhead_type").value = response.type;
                        } else {
                            document.getElementById("txtpayhead_desc").value = "";
                            document.getElementById("txtpayhead_type").value = "";
                        }
                    }
                };

                xhr.send("payhead_id=" + payheadId);
            } else {
                document.getElementById("txtpayhead_desc").value = "";
                document.getElementById("txtpayhead_type").value = "";
            }
        }
    </script>
</body>

</html>