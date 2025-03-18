<?php
if (isset($_POST["btnDelete"])) {
    require_once "config.php";
    include "session_checker_admin.php";
    $sql = "DELETE FROM tblbranches WHERE branchname = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $_POST['deletetxtbranchname']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Delete";
                $module = "Branches Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['deletetxtbranchname'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['executionStatus'] = "Branch Details Deleted";
                    header(("location: branches-management.php"));
                    exit();
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