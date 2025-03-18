<?php
require_once "config.php";
include "session_checker.php";
$sql = "SELECT * FROM tblattendance where employee_id='" . $_SESSION['username'] . "'";

$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance Management</title>
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
                <li class=""><a href="leave-management-employee.php"
                        class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-arrow-circle-left">
                        </i> Leave</a></li>
                <li class="active"><a href="attendance-management-employee.php"
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

            <div class="d-flex align-items-center  justify-content-between me-4 ms-4 mt-4">
                <span class="fs-5 fw-bold">Attendance Management</span>
            </div>
            <!-- Table -->
            <div class="table-responsive m-3">

                <table class="table table-bordered table-striped text-center p-1" id="table">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Attendance ID</th>
                            <th>Employee ID</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Hours Attended</th>
                            <th>Overtime Hours</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['attendance_id'] . "</td>";
                            echo "<td>" . $row['employee_id'] . "</td>";
                            echo "<td>" . $row['time_in'] . "</td>";
                            echo "<td>" . $row['time_out'] . "</td>";
                            echo "<td>" . $row['hours_attended'] . "</td>";
                            echo "<td>" . $row['overtime_hours'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "</tr>";
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
        });
    </script>

    <script defer src="sidebar.js">
    </script>
</body>

</html>