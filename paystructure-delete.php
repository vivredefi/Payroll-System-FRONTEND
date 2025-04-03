<?php
if (isset($_POST["btnDelete"])) {
    require_once "config.php";
    include "session_checker_admin.php";
    $sql = "DELETE FROM tblpaystructures WHERE paystructure_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $_POST['deletetxtpaystructureid']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Delete";
                $module = "Pay Structures Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['deletetxtpaystructureid'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    session_start();
                    $_SESSION['executionStatus'] = "Pay Structure Details Deleted";
                    $_SESSION['txtpaystructureemployee_id'] = $_POST['deletetxtemployeeid'];
                    header(("location: paystructures-management.php"));
                    
                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                }
            }
        } else {
            echo "<font color = 'red'>Error on deleting branch.</font>";
        }
    }
}
?>