<?php
if (isset($_POST["btnAdd"])) {
    require_once "config.php";
    include "session_checker_admin.php";


    // Get the latest ainumber
    $sqlainumber = "SELECT MAX(paystructure_id) AS ainumber FROM tblpaystructures";
    $resultainumber = mysqli_query($link, $sqlainumber);

    $latestainumber = 0;

    if ($row = mysqli_fetch_assoc($resultainumber)) {
        $latestainumber = $row["ainumber"]+1 ?? 0; // Default to 0 if null
    }

    // If there are no records, start from 1
    if ($latestainumber == 0) {
        $latestainumber = 1;
    }

    $sql = "INSERT INTO tblpaystructures(employee_id, payhead_id, paystructure_value) VALUES(?,?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sss", $_POST['txtemployee_id'], $_POST['cmbpayhead_name'], $_POST['txtpaystructure_value']);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "INSERT INTO tbllogs(datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $date = date("m/d/Y");
                $time = date("h:i:s");
                $action = "Add";
                $module = "Pay Structures Management";
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $latestainumber, $_SESSION['username']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Pay Structure created";
                    session_start();
                    $_SESSION['executionStatus'] = "Pay Structure Details Successfully Created";
                    if(isset($_SESSION['txtpaystructureemployee_id'])){
                        unset($_SESSION['txtpaystructureemployee_id']);
                    }
                    
                    $_SESSION['txtpaystructureemployee_id'] = $_POST['txtemployee_id'];
                    header(("location: paystructures-management.php"));
                    exit();
                } else {
                    echo "<font color = 'red'>Error on loading on logs.</font>";
                }
            } 
        }

    }
}

?>