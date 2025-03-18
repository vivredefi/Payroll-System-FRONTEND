<?php
if (isset($_POST["btnDelete"])) {
    require_once "config.php";
    include "session_checker.php";

    $sql = "SELECT * FROM tblleaves WHERE leave_id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $_POST["deletetxtleave_id"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["status"] == "APPROVED") {
                    $_SESSION['executionStatusDanger'] = "Leave request can't be deleted when it is approved";
                    header("location: leave-management-employee.php");
                    exit();
                } else {
                    $sql = "DELETE FROM tblleaves WHERE leave_id = ?";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $_POST['deletetxtleave_id']);
                        if (mysqli_stmt_execute($stmt)) {
                            $sql = "INSERT INTO tbllogs (datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
                            if ($stmt = mysqli_prepare($link, $sql)) {
                                $date = date("m/d/Y");
                                $time = date("h:i:s");
                                $action = "Delete";
                                $module = "Leave Management";
                                mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['deletetxtleave_id'], $_SESSION['username']);
                                if (mysqli_stmt_execute($stmt)) {
                                    $_SESSION['executionStatus'] = "Leave Request Deleted";
                                    header(("location: leave-management-employee.php"));
                                    exit();
                                } else {
                                    echo "<font color = 'red'>Error on inserting logs.</font>";
                                }
                            }
                        } else {
                            echo "<font color = 'red'>Error on deleting branch.</font>";
                        }
                    }
                }
            }
        }
    }


    
}
?>