<?php
require_once "config.php";
include "session_checker_admin.php";
$sql = "SELECT * FROM tblemployees";
$result = mysqli_query($link, $sql);

// Get the latest ainumber
$sqlainumber = "SELECT MAX(ainumber) AS ainumber FROM tblemployees";
$resultainumber = mysqli_query($link, $sqlainumber);

$latestainumber = 0;

if ($row = mysqli_fetch_assoc($resultainumber)) {
    $latestainumber = $row["ainumber"] ?? 0; // Default to 0 if null
}

// If there are no records, start from 100000
if ($latestainumber == 0) {
    $latestainumber = 100000;
}

// Generate employee number
$latestemployeenumber = "EMP" . ($latestainumber + 1);
//echo"". $latestemployeenumber ."";

?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Employees Management</title>
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
                <li class="active"><a href="employees-management.php"
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


            <!-- Add Employee Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="employee-add.php" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModalLabel">Add New Employee</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Fill up this form and submit to add a new employee.</p>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><label class="fw-bold">Employee ID:</label></td>
                                            <td><input type="text" name="txtemployee_id" class="form-control" required
                                                    readonly value="<?php echo $latestemployeenumber; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Name:</label></td>
                                            <td><input type="text" name="txtname" class="form-control" required></td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Password:</label></td>
                                            <td>
                                                <input type="password" name="txtpassword" id="txtpassword"
                                                    class="form-control" required>
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" class="form-check-input custom-checkbox"
                                                        id="showAddPassword">
                                                    <label class="form-check-label" for="showAddPassword">Show
                                                        Password</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Position:</label></td>
                                            <td>
                                                <select name="cmbposition" class="form-select" required>
                                                    <option value="">--Select Job Position--</option>
                                                    <option value="LAUNDRY ATTENDANT">LAUNDRY ATTENDANT</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Branch:</label></td>
                                            <td>
                                                <select name="cmbbranch" class="form-select" required>
                                                    <option value="">--Select Branch--</option>
                                                    <?php
                                                    $addbranchsql = "SELECT * FROM tblbranches";
                                                    $branchresult = mysqli_query($link, $addbranchsql);
                                                    while ($row = mysqli_fetch_array($branchresult)) {
                                                        echo "<option value='" . $row['branchname'] . "'>" . $row['branchname'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
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
            <!-- Edit Employee Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="employee-edit.php" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">Edit Employee Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Fill up this form and submit to edit employee details.</p>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><label class="fw-bold">Employee ID:</label></td>
                                            <td><input type="text" name="edittxtemployee_id" id="edittxtemployee_id"
                                                    class="form-control" required readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Name:</label></td>
                                            <td><input type="text" name="edittxtname" id="edittxtname"
                                                    class="form-control" required></td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Position:</label></td>
                                            <td>
                                                <select name="editcmbposition" id="editcmbposition" class="form-select"
                                                    required>
                                                    <option value="">--Select Job Position--</option>
                                                    <option value="LAUNDRY ATTENDANT">LAUNDRY ATTENDANT</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Branch:</label></td>
                                            <td>
                                                <select name="editcmbbranch" id="editcmbbranch" class="form-select"
                                                    required>
                                                    <option value="">--Select Branch--</option>
                                                    <?php
                                                    $branchresult = mysqli_query($link, $addbranchsql);
                                                    while ($row = mysqli_fetch_array($branchresult)) {
                                                        echo "<option value='" . $row['branchname'] . "'>" . $row['branchname'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
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
            <form action="employee-delete.php" method="POST">
                <div class="modal" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Employee Confirmation</h5>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="deletetxtemployee_id" id="deletetxtemployee_id" readonly><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnDelete">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form action="payslip-add.php" method="POST">
                <div class="modal" id="addPayslipModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Payslip Details</h5>
                            </div>
                            <div class="modal-body">


                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><label class="fw-bold">Employee ID:</label></td>
                                            <td><input type="text" name="addpaysliptxtemployee_id"
                                                    id="addpaysliptxtemployee_id" class="form-control" required
                                                    readonly></td>
                                            <td><input type="text" name="addpaysliptxtemployee_name"
                                                    id="addpaysliptxtemployee_name" class="form-control" required
                                                    readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Month:</label></td>
                                            <td>
                                                <select name="cmbmonth" id="cmbmonth" class="form-control">
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="fw-bold">Position:</label></td>
                                            <td>
                                                <select name="cmbyear" id="cmbyear" class="form-control">
                                                    <?php
                                                    for ($year = 2025; $year <= 2050; $year++) {
                                                        echo "<option value=\"$year\">$year</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnPayslipAdd">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- ADD NEW BUTTON -->
            <div class="d-flex align-items-center justify-content-between me-4 ms-4 mt-4">
                <span class="fs-5 fw-bold">Employees Management</span>
                <button type="button" class="btn btn-primary btn-sm fs-6 bg-dark text-white" data-bs-toggle="modal"
                    data-bs-target="#addModal">Add New Employee
                </button>
            </div>
            <!-- Table -->
            <div class="table-responsive m-3">
                <table class="table table-bordered table-striped text-center p-1" id="table">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Branch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['employee_id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['position'] . "</td>";
                            echo "<td>" . $row['branch'] . "</td>";
                            echo "<td>";
                            echo "<a class='btn btn-small editbtn'><img src='editicon.png' alt='Edit' height='15' width='15'></a>";
                            echo "<a class='btn btn-small deletebtn'><img src='deleteicon.png' alt='Edit' height='17' width='15'></a>";
                            echo "<a class='btn btn-small payslipaddbtn'><img src='file.png' alt='Edit' height='17' width='15'></a>";
                            echo "
                            <form action='paystructures-management.php' method='POST'> 
                            <input type='text'  value='" . $row['employee_id'] . "' name='txtpaystructureemployee_id' hidden required>
                            <input type='submit' class='btn btn-small' name='btnStructure' value='Pay Structure'></input>
                            </form>
                            ";
                            echo "</td>";

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

            // Event delegation for edit button
            $(document).on("click", ".editbtn", function () {
                // Find the closest row of the clicked button
                const $row = $(this).closest("tr");

                // Extract data from the row
                const employeeId = $row.find("td:eq(0)").text();
                const name = $row.find("td:eq(1)").text();
                const position = $row.find("td:eq(2)").text();
                const branch = $row.find("td:eq(3)").text();

                // Populate the modal fields
                $("#edittxtemployee_id").val(employeeId);
                $("#edittxtname").val(name);
                $("#editcmbposition").val(position);
                $("#editcmbbranch").val(branch);

                // Show the modal
                $("#editModal").modal("show");
            });

            // Event delegation for delete button
            $(document).on("click", ".deletebtn", function () {
                // Find the closest row of the clicked button
                const $row = $(this).closest("tr");

                // Extract the employee ID from the row
                const employeeId = $row.find("td:eq(0)").text();

                // Populate the modal field
                $("#deletetxtemployee_id").val(employeeId);

                // Show the modal
                $("#deleteModal").modal("show");
            });

            $(document).on("click", ".payslipaddbtn", function () {
                // Find the closest row of the clicked button
                const $row = $(this).closest("tr");

                // Extract the employee ID from the row
                const employeeId = $row.find("td:eq(0)").text();
                const employeeName = $row.find("td:eq(1)").text();
                // Populate the modal field
                $("#addpaysliptxtemployee_id").val(employeeId);
                $("#addpaysliptxtemployee_name").val(employeeName);
                // Show the modal
                $("#addPayslipModal").modal("show");
            });
        });

    </script>
    <script defer src="sidebar.js">
    </script>
    <script>
        // Show/Hide Password for Add Modal
        document.getElementById("showAddPassword").addEventListener("change", function () {
            const passwordField = document.getElementById("txtpassword");
            passwordField.type = this.checked ? "text" : "password";
        });
    </script>
</body>

</html>