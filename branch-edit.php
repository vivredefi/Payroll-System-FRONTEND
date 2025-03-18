<?php
if (isset($_POST["btnEdit"])) {
    require_once "config.php";
    include "session_checker_admin.php";

    $sql = "UPDATE tblbranches SET address =? WHERE branchname = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $_POST['edittxtaddress'], $_POST['edittxtbranchname']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Update";
                $module = "Branches Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['edittxtusername'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "branch details updated";
                    session_start();
                    $_SESSION['executionStatus'] = "Branch Details Successfully Updated";
                    header(("location: branches-management.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                }
            }
        } else {
            echo "<font color = 'red'>Error on updating branch details.</font>";
        }
    }
}
?>