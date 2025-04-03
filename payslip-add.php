<?php
if (isset($_POST["btnPayslipAdd"])) {
    require_once "config.php";
    include "session_checker_admin.php";

    $date = date("m/d/Y");
    $time = date("h:i:s");
    $datetime = $date . $time;
    $employee_id = $_POST['addpaysliptxtemployee_id'];
    $employee_name = $_POST['addpaysliptxtemployee_name'];
    $month = $_POST['cmbmonth'];
    $year = $_POST['cmbyear'];

    $days_present = 0;
    $overtime_hours = 0;

    $attendance_sql = "SELECT * FROM vw_monthly_attendance WHERE employee_id = '" . $employee_id . "' AND month ='" . $month . "' AND year ='" . $year . "'";

    $attendance_result = mysqli_query($link, $attendance_sql);

    if (!$attendance_result) {
        die("Query failed: " . mysqli_error($link));  // Show SQL error
    }
    while ($row = mysqli_fetch_assoc($attendance_result)) {
        $days_present = intval($row['days_present']);
        $overtime_hours = intval($row['total_overtime']);
    }







    $paystructure_sql = "SELECT 
    tblpaystructures.paystructure_id,
    tblpaystructures.paystructure_value,
    tblemployees.employee_id,
    tblemployees.name,
    tblemployees.position,
    tblemployees.branch,
    tblpayheads.payhead_id,
    tblpayheads.payhead_name,
    tblpayheads.payhead_desc,
    tblpayheads.payhead_type
FROM tblpaystructures
INNER JOIN tblemployees ON tblpaystructures.employee_id = tblemployees.employee_id
INNER JOIN tblpayheads ON tblpaystructures.payhead_id = tblpayheads.payhead_id WHERE tblemployees.employee_id = '" . $employee_id . "'";
    $paystructure_result = mysqli_query($link, $paystructure_sql);

    $basic_salary = 0;
    $gross_pay = 0;
    $total_deductions = 0;



    while ($row = mysqli_fetch_assoc($paystructure_result)) {
        if ($row['payhead_id'] == 1) {
            $basic_salary = ((floatval($row["paystructure_value"] / 28)) * $days_present);
            $basic_salary = sprintf("%.2f", $basic_salary);
            $sql = "INSERT INTO tblsalaries(employee_id, payhead_id, pay_amount, month, year, datecreated) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssss", $employee_id, $row['payhead_id'], $basic_salary, $month, $year, $datetime);
                mysqli_stmt_execute($stmt);
            } else {
                echo "error1";
            }
            $gross_pay = $gross_pay + $basic_salary;
            $gross_pay = sprintf("%.2f", $gross_pay);
        } elseif ($row['payhead_id'] == 2) {
            $pay_amount = (((floatval($row["paystructure_value"]) / 28) / 8) * $overtime_hours) * 1.3;

            $sql = "INSERT INTO tblsalaries(employee_id, payhead_id, pay_amount, month, year, datecreated) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssss", $employee_id, $row['payhead_id'], $pay_amount, $month, $year, $datetime);
                mysqli_stmt_execute($stmt);
            } else {
                echo "error2";
            }
            $gross_pay = $gross_pay + $pay_amount;
            $gross_pay = sprintf("%.2f", $gross_pay);
        } else {
            $pay_amount = 0;
            if ($row["payhead_type"] == "EARNINGS") {
                $pay_amount = floatval($row['paystructure_value']);
                $gross_pay = $gross_pay + $pay_amount;
                $gross_pay = sprintf("%.2f", $gross_pay);
            } else {
                $pay_amount = floatval($row['paystructure_value']) * -1;
                $total_deductions = $total_deductions + $pay_amount;
                $total_deductions = sprintf("%.2f", $total_deductions);
            }

            $sql = "INSERT INTO tblsalaries(employee_id, payhead_id, pay_amount, month, year, datecreated) VALUES(?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssss", $employee_id, $row['payhead_id'], $pay_amount, $month, $year, $datetime);
                mysqli_stmt_execute($stmt);
            } else {
                echo "error3";
            }
        }
    }
    $net_pay = $gross_pay + $total_deductions;
    $net_pay = sprintf("%.2f", $net_pay);

    $sql = "INSERT INTO tblpayslips(employee_id,name, gross_pay, total_deductions, net_pay, month, year, datecreated) VALUES(?,?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $employee_id, $employee_name, $gross_pay, $total_deductions, $net_pay, $month, $year, $datetime);
        mysqli_stmt_execute($stmt);
        session_start();
        $_SESSION['executionStatus'] = "Payslip Details Successfully Created";
        header(("location: employees-management.php"));
    } else {
        echo "error3";
    }
}
?>