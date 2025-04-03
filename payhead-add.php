<?php
if (isset($_POST["btnAdd"])) {
    require_once "config.php";
    include "session_checker_admin.php";


    $sql = "INSERT INTO tblpayheads(payhead_name, payhead_desc, payhead_type) VALUES(?,?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sss", $_POST['txtpayheadname'], $_POST['txtpayheaddesc'], $_POST['txtpayheadtype']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs(datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Add";
                $module = "Payhead Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['txtpayheadid'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Payhead created";
                    $_SESSION['executionStatus'] = "Payhead Details Successfully Created";
                    header(("location: payheads-management.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on loading on logs.</font>";
                }
            }else {
                echo "<font color = 'red'>Error on loading on logs1.</font>";
            }
        }
        else {
            echo "<font color = 'red'>Error on loading on logs.2</font>";
        }
    }
    else {
        echo "<font color = 'red'>Error on loading on logs.3</font>";
    }
}

?>