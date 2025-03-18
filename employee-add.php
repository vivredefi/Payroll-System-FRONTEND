<?php
if (isset($_POST["btnAdd"])) {
    require_once "config.php";
    include "session_checker_admin.php";
    if (isset($_POST['btnAdd'])) {
        $sql = "INSERT INTO tblemployees(employee_id, name, position, branch, dailyrate, createdby, datecreated) VALUES(?,?,?,?,?,?,NOW())";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $_POST['txtemployee_id'], $_POST['txtname'], $_POST['cmbposition'], $_POST['cmbbranch'], $_POST['txtdailyrate'], $_SESSION['username']);
            if (mysqli_stmt_execute($stmt)) {
                $sql = "INSERT INTO tbllogs(datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    $date = date("m/d/Y");
                    $time = date("h:i:s");
                    $action = "Add";
                    $module = "Employee Management";
                    mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['txtemployee_id'], $_SESSION['username']);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "Employee created";
                        $_SESSION['executionStatus'] = "Employee Details Successfully Created";
                    } else {
                        echo "<font color = 'red'>Error on loading on logs.</font>";
                    }
                }
            } else {
                echo "<font color = 'red'>Error on adding new employee.</font>";
            }
        }
        $usertype = "";
        if ($_POST['txtposition'] == "ADMINISTRATOR") {
            $usertype = "ADMINISTRATOR";
        } else {
            $usertype = "STAFF";
        }
        $sql = "INSERT INTO tblaccounts(username, userpass, usertype, userstatus, createdby, datecreated) VALUES(?,?,?,'ACTIVE',?,NOW())";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $_POST['txtemployee_id'], $_POST['txtpassword'], $usertype, $_SESSION['username']);
            if (mysqli_stmt_execute($stmt)) {
                $sql = "INSERT INTO tbllogs(datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    $date = date("m/d/Y");
                    $time = date("h:i:s");
                    $action = "Add";
                    $module = "Account Management";
                    mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['txtemployee_id'], $_SESSION['username']);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "Account created";
                        $_SESSION['executionStatus'] = "Employee and Account Details Successfully Created";
                        header(("location: employees-management.php"));
                        exit();
                    } else {
                        echo "<font color = 'red'>Error on loading on logs.</font>";
                    }
                }
            } else {
                echo "<font color = 'red'>Error on adding new employee.</font>";
            }
        }
    }
}

?>