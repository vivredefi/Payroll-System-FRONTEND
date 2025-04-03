<?php
require_once "config.php";
include "session_checker_admin.php";
$sql = "SELECT * FROM tblpayheads";
$result = mysqli_query($link, $sql);
// Get the latest ainumber
$sqlainumber = "SELECT MAX(payhead_id) AS payhead_id FROM tblpayheads";
$resultainumber = mysqli_query($link, $sqlainumber);

$latestainumber = 0;

if ($row = mysqli_fetch_assoc($resultainumber)) {
    $latestainumber = $row["payhead_id"] + 1 ?? 0; // Default to 0 if null
}

// If there are no records, start from 100000
if ($latestainumber == 0) {
    $latestainumber = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pay Heads Management</title>
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
                <li class="active"><a href="payheads-management.php"
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
            <!-- Add Payheads Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="payhead-add.php" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModalLabel">Add New Pay Head Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Fill up this form and submit to create a new Pay Head details.</p>
                                <table class="table table-borderless">
                                    <tbody>
                                        <?php
                                        echo ("<input type='text' name='txtpayheadid' value='" . $latestainumber . "' hidden>");
                                        ?>
                                        <tr>
                                            <td><label class="fw-bold">Pay Head Name:</label></td>
                                            <td><input type="text" name="txtpayheadname" class="form-control" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Type:</label></td>

                                            <td><select name="txtpayheadtype" id="txtpayheadtype"
                                                    class="form-control" required>
                                                    <option value="">--Select Type--</option>
                                                    <option value="EARNINGS">EARNINGS</option>
                                                    <option value="DEDUCTIONS">DEDUCTIONS</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Description:</label></td>
                                            <td><input type="text" name="txtpayheaddesc" class="form-control" required>
                                            </td>
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

            <!-- Edit Payheads Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="payhead-edit.php" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">Edit Pay Head Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Fill up this form and submit to edit Pay Head details.</p>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="edittxtpayheadid" id="edittxtpayheadid"
                                                    class="form-control" required readonly hidden>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Payhead Name:</label></td>
                                            <td><input type="text" name="edittxtpayheadname" id="edittxtpayheadname"
                                                    class="form-control" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Type:</label></td>

                                            <td><select name="edittxtpayheadtype" id="edittxtpayheadtype"
                                                    class="form-control" required>
                                                    <option value="">--Select Type--</option>
                                                    <option value="EARNINGS">EARNINGS</option>
                                                    <option value="DEDUCTIONS">DEDUCTIONS</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Description:</label></td>
                                            <td><input type="text" name="edittxtpayheaddesc" id="edittxtpayheaddesc"
                                                    class="form-control" required></td>
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
            <form action="payhead-delete.php" method="POST">
                <div class="modal" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Pay Head Details Confirmation</h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this Pay Head details?</p>
                                <input type="hidden" name="deletetxtpayheadid" id="deletetxtpayheadid" readonly><br>

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
                <span class="fs-5 fw-bold">Payhead Management</span>
                <button type="button" class="btn btn-primary btn-sm fs-6 bg-dark text-white" data-bs-toggle="modal"
                    data-bs-target="#addModal">Add New Pay Head
                </button>
            </div>
            <!-- Table -->
            <div class="table-responsive m-3">
                <table class="table table-bordered table-striped text-center p-1" id="table">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Pay Head ID</th>
                            <th>Pay Head Name</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            if($row['payhead_id']!=1 || $row['payhead_id']!=2){
                                echo "<tr>";
                                echo "<td>" . $row['payhead_id'] . "</td>";
                                echo "<td>" . $row['payhead_name'] . "</td>";
                                echo "<td>" . $row['payhead_desc'] . "</td>";
                                echo "<td>" . $row['payhead_type'] . "</td>";
                                echo "<td>";
                                echo "<a class='btn btn-small editbtn'><img src='editicon.png' alt='Edit' height='15' width='15'></a>";
                                echo "<a class='btn btn-small deletebtn'><img src='deleteicon.png' alt='Delete' height='17' width='15'></a>";
                                echo "</td>";
                                echo "</tr>";
                            }else{
                                echo "<tr>";
                                echo "<td>" . $row['payhead_id'] . "</td>";
                                echo "<td>" . $row['payhead_name'] . "</td>";
                                echo "<td>" . $row['payhead_desc'] . "</td>";
                                echo "<td>" . $row['payhead_type'] . "</td>";
                                echo "<td>";
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
                const payheadid = $row.find("td:eq(0)").text();
                const payheadname = $row.find("td:eq(1)").text();
                const payheaddesc = $row.find("td:eq(2)").text();
                const payheadtype = $row.find("td:eq(3)").text();


                // Populate the modal fields
                $("#edittxtpayheadid").val(payheadid);
                $("#edittxtpayheadname").val(payheadname);
                $("#edittxtpayheaddesc").val(payheaddesc);
                $("#edittxtpayheadtype").val(payheadtype);

                // Show the modal
                $("#editModal").modal("show");
            });

            // Event delegation for delete button
            $(document).on("click", ".deletebtn", function () {
                // Find the closest row of the clicked button
                const $row = $(this).closest("tr");

                // Extract the employee ID from the row
                const payheadid = $row.find("td:eq(0)").text();

                // Populate the modal field
                $("#deletetxtpayheadid").val(payheadid);

                // Show the modal
                $("#deleteModal").modal("show");
            });
        });

    </script>
    <script defer src="sidebar.js">
</body >

</html >