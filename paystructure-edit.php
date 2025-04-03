<?php
if (isset($_POST["btnEdit"])) {
    require_once "config.php";
    include "session_checker_admin.php";
    $sql = "UPDATE tblpaystructures SET paystructure_value =? WHERE paystructure_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $_POST['edittxtpaystructurevalue'], $_POST['edittxtpaystructureid']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Update";
                $module = "Pay Structures Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['edittxtpaystructureid'], $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Pay Structure details updated";
                    session_start();
                    if(isset($_SESSION['txtpaystructureemployee_id'])){
                        unset($_SESSION['txtpaystructureemployee_id']);
                    }
                    $_SESSION['txtpaystructureemployee_id'] = $_POST['edittxtemployeeid'];
                    $_SESSION['executionStatus'] = "Pay Structure Details Successfully Updated";
                    
                    header(("location: paystructures-management.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on inserting logs.</font>";
                }
            }
        } else {
            echo "<font color = 'red'>Error on updating pay structure details.</font>";
        }
    }
}
?>