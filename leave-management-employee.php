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
        LEFT JOIN tblleaves ON tblemployees.employee_id = tblleaves.employee_id 
        WHERE tblemployees.employee_id='" . $username . "'";

$result = mysqli_query($link, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Leave Management</title>
    <link rel="stylesheet" href="sidebar.css">
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
                <li class=""><a href="payslips-management-employee.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark">
                        <i class="fal fa-home"></i> Payslips
                    </a></li>
                <li class="active"><a href="leave-management-employee.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-arrow-circle-left">
                        </i> Leave</a></li>
                <li class=""><a href="attendance-management-employee.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-clock"></i>
                        Attendance</a></li>
                <li class=""><a href="logout.php" class="text-decoration-none px-3 py-2 d-block text-dark"><i
                            class="fal fa-sign-out"></i>
                        Logout</a></li>
                <li>
                    <form action="time-inout.php" method="post" class="text-decoration-none d-block w-100">
                        <input class="active  btn btn-dark btn-pill w-100" type="button" id="btntimeinout"
                            value="Time In / Out">
                    </form>
                </li>
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

            <div class="modal fade" id="timeModal" tabindex="-1" aria-labelledby="timeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="time-inout.php" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModalLabel">Time In</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure to time in / out?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="btntimeinout" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Leave Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="leave-add.php" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModalLabel">Add New Leave</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                <div class="modal-body">
                            <?php
                                if (isset($_SESSION['executionStatuss'])) {
                                    echo "<script>$('#addModal').modal('show');</script>";
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" . $_SESSION['executionStatuss'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                    unset($_SESSION['executionStatuss']);
                                    echo "<script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Get the modal element
                                            var modal = document.getElementById('addModal');
                                            // Create a new Bootstrap modal instance
                                            var modalInstance = new bootstrap.Modal(modal);
                                            // Show the modal
                                            modalInstance.show();
                                        });
                                        </script>";
                                }
                                ?>
                    <p>Fill up this form and submit to create a new leave request.</p>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label class="fw-bold">Date From:</label></td>
                                <td><input type="date" name="txtdatefrom" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td><label class="fw-bold">Date To:</label></td>
                                <td><input type="date" name="txtdateto" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td><label class="fw-bold">Type of Leave:</label></td>
                                <td>
                                    <select name="cmbtype" class="form-select" required>
                                        <option value="">--Select Leave Type--</option>
                                        <option value="Casual Leave">Casual Leave</option>
                                        <option value="Sick Leave">Sick Leave</option>
                                        <option value="Maternal Leave">Maternal Leave</option>
                                        <option value="Paternal Leave">Paternal Leave</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="fw-bold">Message:</label></td>
                                <td><textarea name="txtmessage" class="form-control" rows="3" required></textarea></td>
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
            <form action="leave-delete.php" method="POST">
                <div class="modal" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Leave Request Confirmation</h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this leave request?</p>
                                <input type="hidden" name="deletetxtleave_id" id="deletetxtleave_id" readonly><br>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnDelete">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- ADD NEW BUTTON -->
            <div class="d-flex align-items-center  justify-content-between me-4 ms-4 mt-4">
                <span class="fs-5 fw-bold">Leave Management</span>
                <button type="button" class="btn btn-primary btn-sm fs-6 bg-dark text-white" data-bs-toggle="modal"
                    data-bs-target="#addModal">Add New Leave Request
                </button>
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
                            <th>Message</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Delete</th>
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
                                echo "<a class='btn btn-small deletebtn'><img src='deleteicon.png' alt='Edit' height='15' width='15'></a>";
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

            $(document).on('click', '.addbtn', function () {
                $('#timeModal').modal("show");
            });

            $(document).on("click", ".deletebtn", function () {
                const $row = $(this).closest("tr");

                // Extract the employee ID from the row
                const leaveid = $row.find("td:eq(0)").text();

                // Populate the modal field
                $("#deletetxtleave_id").val(leaveid);

                // Show the modal
                $("#deleteModal").modal("show");
            });
        });
    </script>

    <script defer src="sidebar.js">
    </script>
</body>

</html>