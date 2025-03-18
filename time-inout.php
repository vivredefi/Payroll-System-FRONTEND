<?php
require_once "config.php";
include("session_checker.php");

if (isset($_POST['btntimeinout'])) {
    $date = date("m/d/Y");
    $sql = "SELECT * FROM tblattendance WHERE employee_id='" . $_SESSION['username'] . "' AND date='" . $date . "'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) { // Check if a record exists for today
        // If the user is clocking out (time out)
        $timeout = date("H:i:s"); // Use 24-hour format for easier time difference calculation
        $timein = $row["time_in"];

        // Calculate the time difference (hours attended)
        $time1 = new DateTime($timein);
        $time2 = new DateTime($timeout);
        $interval = $time2->diff($time1);

        // Get total hours attended
        $hours_attended = $interval->format('%h');
        $overtime_hours = 0;
        if (intval($hours_attended) > 8) {
            $overtime_hours = intval($hours_attended) - 8;
        }
        // Update the record with time out and hours attended
        $update_sql = "UPDATE tblattendance SET time_out = ?, hours_attended = ?, overtime_hours = ? WHERE employee_id = ? AND date = ?";
        if ($stmt = mysqli_prepare($link, $update_sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $timeout, $hours_attended, $overtime_hours, $_SESSION['username'], $date);
            if (mysqli_stmt_execute($stmt)) {
                header("location: attendance-management-employee.php");
            } else {
                echo "<font color = 'red'>Error updating time out.</font>";
            }
        }
    } else {
        // If no attendance record for today, insert a time-in record
        $time_in = date("H:i:s");
        $insert_sql = "INSERT INTO tblattendance (employee_id, time_in, date) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $insert_sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $_SESSION['username'], $time_in, $date);
            if (mysqli_stmt_execute($stmt)) {
                header("location: attendance-management-employee.php");
            } else {
                echo "<font color = 'red'>Error on time in.</font>";
            }
        }
    }
}
?>