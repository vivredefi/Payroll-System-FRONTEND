<?php
if(isset($_POST["btnEdit"])){
require_once "config.php";
include "session_checker_admin.php";

$sql = "UPDATE tblemployees SET name = ?, position=?, branch=?, dailyrate=? WHERE employee_id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "sssss", $_POST['edittxtname'], $_POST['editcmbposition'], $_POST['editcmbbranch'], $_POST['edittxtdailyrate'], $_POST['edittxtemployee_id']);
    if (mysqli_stmt_execute($stmt)) {
        $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            $date = date("m/d/Y");
            $time = date("h:i:s");
            $action = "Update";
            $module = "Employees Management";
            mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['edittxtemployee_id'], $_SESSION['username']);
            if (mysqli_stmt_execute($stmt)) {
                echo "employee details updated";
                session_start();
                $_SESSION['executionStatus'] = "Employee Details Successfully Updated";
                header(("location: employees-management.php"));
                exit();
            } else {
                echo "<font color = 'red'>Error on inserting logs.</font>";
            }
        }
    } else {
        echo "<font color = 'red'>Error on updating employee details.</font>";
    }
}

echo $_POST['edittxtname'] . $_POST['editcmbposition'] . $_POST['editcmbbranch'] . $_POST['edittxtdailyrate'] . $_POST['edittxtemployee_id'];
}
?>