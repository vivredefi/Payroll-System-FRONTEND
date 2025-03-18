<?php
require_once "config.php";
include("session_checker_admin.php");

if (isset($_POST["btnApprove"])) {
    $leave_id = $_POST["approvetxtleave_id"];
    $sql = "UPDATE tblleaves SET status = 'APPROVED' WHERE leave_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $leave_id);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Update";
                $module = "Leave Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $leave_id, $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "leave request details updated";
                    session_start();
                    $_SESSION['executionStatus'] = "Leave Request Details Successfully Updated";
                    header(("location: leave-management-admin.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                }
            }
        } else {
            echo "<font color = 'red'>Error on updating leave request details.</font>";
        }
    }
}
if (isset($_POST["btnDecline"])) {
    $leave_id = $_POST["declinetxtleave_id"];
    $sql = "UPDATE tblleaves SET status = 'DECLINED' WHERE leave_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $leave_id);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Update";
                $module = "Leave Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $leave_id, $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "leave request details updated";
                    session_start();
                    $_SESSION['executionStatus'] = "Leave Request Details Successfully Updated";
                    header(("location: leave-management-admin.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                }
            }
        }
    }
}
?>