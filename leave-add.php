<?php
if (isset($_POST["btnAdd"])) {
    require_once "config.php";
    include("session_checker.php");

    $dateFrom = $_POST['txtdatefrom'];
    $dateTo = $_POST['txtdateto'];
    $message = $_POST['txtmessage'];
    $type = $_POST['cmbtype'];
    $employeeId = $_SESSION['username']; // Ensure this stores the correct employee ID

    $newDateFrom = date("m/d/Y", strtotime($dateFrom));
    $newDateTo = date("m/d/Y", strtotime($dateTo));

    $sql = "SELECT * FROM tblleaves 
            WHERE STR_TO_DATE(date_from, '%m/%d/%y') <= STR_TO_DATE(?, '%m/%d/%y')
            AND STR_TO_DATE(date_to, '%m/%d/%y') >= STR_TO_DATE(?, '%m/%d/%y')
            AND employee_id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sss", $newDateTo, $newDateFrom, $employeeId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Conflict found, reject leave request
            $_SESSION['executionStatuss'] = "Leave request conflicts with an existing leave";
            header("location: leave-management-employee.php");
            exit();
        }

        mysqli_stmt_close($stmt);
    }

    // If no conflicts, proceed to insert new leave request
    $sql = "INSERT INTO tblleaves(employee_id, date_from, date_to, message, status, type) VALUES(?, ?, ?, ?, 'PENDING',?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $employeeId, $newDateFrom, $newDateTo, $message, $type);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt); // Close before inserting logs

            // Insert log entry
            $sql = "INSERT INTO tbllogs(datelog, timelog, action, module, employee_id, performedby) 
                    VALUES(?, ?, ?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Add";
                $module = "Leave Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $employeeId, $employeeId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            header("location: leave-management-employee.php");
            exit();
        } else {
            echo "<font color='red'>Error on adding leave request.</font>";
        }
    }


}
?>