<?php
require_once "config.php";
include "session_checker.php";
$username = $_SESSION['username'];
$sql = "SELECT tblleaves.leave_id AS leave_id, 
               tblleaves.employee_id AS employee_id, 
               tblemployees.name AS name, 
               tblleaves.date_from AS date_from, 
               tblleaves.date_to AS date_to, 
               tblleaves.message AS message,
               tblleaves.type AS type, 
               tblleaves.status AS status 
        FROM tblemployees 
        LEFT JOIN tblleaves ON tblemployees.employee_id = tblleaves.employee_id ";

$result = mysqli_query($link, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Leave Management</title>
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
                <li class="active"><a href="leave-management-admin.php"
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

            <?php
            if (isset($_SESSION['executionStatus'])) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . $_SESSION['executionStatus'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                unset($_SESSION['executionStatus']);
            }
            if (isset($_SESSION['executionStatusDanger'])) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" . $_SESSION['executionStatusDanger'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                unset($_SESSION['executionStatusDanger']);
            }
            ?>



            <form action="leave-approve-decline.php" method="POST">
                <div class="modal" id="approveModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Approve Leave Request Confirmation</h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to approve this leave request?</p>
                                <input type="hidden" name="approvetxtleave_id" id="approvetxtleave_id" readonly><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnApprove">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form action="leave-approve-decline.php" method="POST">
                <div class="modal" id="declineModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Decline Leave Request Confirmation</h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to decline this leave request?</p>
                                <input type="hidden" name="declinetxtleave_id" id="declinetxtleave_id" readonly><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnDecline">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="d-flex align-items-center  justify-content-between me-4 ms-4 mt-4">
                <span class="fs-5 fw-bold">Leave Management</span>
            </div>
            <!-- Table -->
            <div class="table-responsive m-3">

                <table class="table table-bordered table-striped text-center p-1" id="table">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Leave ID</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Date From</th>
                            <th>Date To</th>
                            <th style="width:200px">Message</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = mysqli_fetch_assoc($result)) {
                            if (!is_null($row['leave_id'])) {
                                echo "<tr>";
                                echo "<td>" . $row['leave_id'] . "</td>";
                                echo "<td>" . $row['employee_id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['date_from'] . "</td>";
                                echo "<td>" . $row['date_to'] . "</td>";
                                echo "<td>" . $row['message'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";

                                echo "<td>";
                                echo "<a class='btn btn-small approvebtn'><img src='approve.png' alt='Edit' height='17' width='15'></a>";
                                echo "<a class='btn btn-small declinebtn'><img src='deleteicon.png' alt='Edit' height='15' width='15'></a>";
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

            $(document).on('click', '#btntimeinout', function () {
                $('#timeModal').modal("show");
            });


            $(document).on("click", ".approvebtn", function () {
                const $row = $(this).closest("tr");

                // Extract the employee ID from the row
                const leaveid = $row.find("td:eq(0)").text();

                // Populate the modal field
                $("#approvetxtleave_id").val(leaveid);

                // Show the modal
                $("#approveModal").modal("show");
            });

            $(document).on("click", ".declinebtn", function () {
                const $row = $(this).closest("tr");

                // Extract the employee ID from the row
                const leaveid = $row.find("td:eq(0)").text();

                // Populate the modal field
                $("#declinetxtleave_id").val(leaveid);

                // Show the modal
                $("#declineModal").modal("show");
            });
        });
    </script>

    <script defer src="sidebar.js">
    </script>
</body>

</html>