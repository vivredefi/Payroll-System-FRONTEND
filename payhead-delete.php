<?php
if (isset($_POST["btnDelete"])) {
    require_once "config.php";
    include "session_checker_admin.php";
    $sql = "DELETE FROM tblpayheads WHERE payhead_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $_POST['deletetxtpayheadid']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Delete";
                $module = "Payheads Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['deletetxtpayheadid'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['executionStatus'] = "Pay Head Details Deleted";
                    header(("location: payheads-management.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                    echo($_POST['deletetxtpayheadid']);
                }
            }
        } else {
            echo "<font color = 'red'>Error on deleting payhead.</font>";
        }
    }
}
?>