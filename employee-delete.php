<?php
if (isset($_POST["btnDelete"])) {
    require_once "config.php";
    include "session_checker_admin.php";
    $employeeid = $_POST['deletetxtemployee_id'];


    $sql = "DELETE FROM tblemployees WHERE employee_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $employeeid);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Delete";
                $module = "Employees Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['deletetxtemployee_id'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {

                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                }
            }
        } else {
            echo "<font color = 'red'>Error on deleting employee.</font>";
        }
    }


    $sql = "DELETE FROM tblaccounts WHERE username = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $employeeid);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Delete";
                $module = "Accounts Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['deletetxtemployee_id'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['executionStatus'] = "Employee Details and Account Successfully Deleted";
                    header(("location: employees-management.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                }
            }
        } else {
            echo "<font color = 'red'>Error on deleting employee.</font>";
        }
    }
}
?>