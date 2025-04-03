<?php
if (isset($_POST["btnEdit"])) {
    require_once "config.php";
    include "session_checker_admin.php";

    $sql = "UPDATE tblpayheads SET payhead_name =?, payhead_desc=?, payhead_type=? WHERE payhead_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $_POST['edittxtpayheadname'], $_POST['edittxtpayheaddesc'], $_POST['edittxtpayheadtype'], $_POST['edittxtpayheadid']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Update";
                $module = "Pay Head Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['edittxtpayheadid'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Payhead details updated";
                    session_start();
                    $_SESSION['executionStatus'] = "Pay Head Details Successfully Updated";
                    header(("location: payheads-management.php"));
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