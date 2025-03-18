<?php
if (isset($_POST["btnDelete"])) {
    require_once "config.php";
    include "session_checker_admin.php";

    $sql = "UPDATE tblaccounts SET userpass = ?, usertype=?, userstatus=? WHERE username = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $_POST['edittxtuserpass'], $_POST['editcmbusertype'], $_POST['editcmbuserstatus'], $_POST['edittxtusername']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Update";
                $module = "Account Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['edittxtusername'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "account details updated";
                    session_start();
                    $_SESSION['executionStatus'] = "Accounts Details Successfully Updated";
                    header(("location: accounts-management.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                }
            }
        } else {
            echo "<font color = 'red'>Error on updating account details.</font>";
        }
    }
}
?>