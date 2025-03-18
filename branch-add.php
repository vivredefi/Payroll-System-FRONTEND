<?php
if (isset($_POST["btnAdd"])) {
    require_once "config.php";
    include "session_checker_admin.php";

    $sql = "SELECT * FROM tblbranches WHERE branchname = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $_POST['txtbranchname']);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 0) {
                $sql = "INSERT INTO tblbranches(branchname, address, createdby, datecreated) VALUES(?,?,?,NOW())";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $_POST['txtbranchname'], $_POST['txtaddress'], $_SESSION['username']);
                    if (mysqli_stmt_execute($stmt)) {
                        $sql = "INSERT INTO tbllogs(datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            $date = date("m/d/Y");
                            $time = date("h:i:s");
                            $action = "Add";
                            $module = "Account Management";
                            mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['txtbranchname'], $_SESSION['username']);
                            if (mysqli_stmt_execute($stmt)) {
                                echo "Account created";
                                $_SESSION['executionStatus'] = "Branch Details Successfully Created";
                                header(("location: branches-management.php"));
                                exit();
                            } else {
                                echo "<font color = 'red'>Error on loading on logs.</font>";
                            }
                        }
                    } else {
                        echo "<font color = 'red'>Error on adding new employee.</font>";
                    }
                }
            } else {
                session_start();
                $_SESSION['executionStatuss'] = "Branch Name: " . $_POST['txtbranchname'] . " already in use";
                header(("location: branches-management.php"));
                exit();
            }
        } else {
            echo "<font color = 'red'>Error on checking if username is existing</font>";
        }
    }
}
?>