<?php
require('./fpdf186/fpdf.php');
require_once "config.php";

if (isset($_POST['btnGenerate'])) {
    include "session_checker.php";

    $pdf = new FPDF();
    $pdf->AddPage();


    $payslipid = $_POST['generatetxtpayslipid'];
    $employeeid = $_POST['generatetxtemployeeid'];
    $employeename = $_POST['generatetxtemployeename'];
    $grosspay = $_POST['generatetxtgrosspay'];
    $totaldeductions = $_POST['generatetxttotaldeductions'];
    $netpay = $_POST['generatetxtnetpay'];
    $month = $_POST['generatetxtmonth'];
    $year = $_POST['generatetxtyear'];
    $payperiod = $month . "/" . $year;
    $employeeposition = "";
    $monthlyrate = "";
    $dailyrate = "";
    $dayspresent = 0;
    $overtimehours = 0;



    $attendancesql = "SELECT * FROM vw_monthly_attendance WHERE employee_id = '$employeeid' AND month = '$month' AND year = '$year'";
    $attendanceresult = mysqli_query($link, $attendancesql);


    while ($row = mysqli_fetch_assoc($attendanceresult)) {
        //$row['total_hours_attended'];
        $overtimehours = $row['total_overtime'];
        $dayspresent = $row['days_present'];
    }


    $employeesql = "SELECT * FROM tblemployees WHERE employee_id = '$employeeid'";
    $employeeresult = mysqli_query($link, $employeesql);

    while ($row = mysqli_fetch_assoc($employeeresult)) {
        //$row['total_hours_attended'];
        $employeeposition = $row['position'];
    }







    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(0, 10, 'PAYSLIP', 1, 1, 'C', true);
    $pdf->Ln(5);

    $pdf->SetTextColor(0, 0, 0);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'Employee Details', 1, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(95, 7, "Name: $employeename", 1);
    $pdf->Cell(95, 7, "Position: $employeeposition", 1, 1);
    $pdf->Cell(95, 7, "Payroll Period: $payperiod", 1);
    $pdf->Cell(0, 7, "Daily Rate: Php 500", 1, 1);
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(130, 7, 'INCOME PARTICULARS', 1, 0, 'C');
    $pdf->Cell(60, 7, 'AMOUNT', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 10);



    $paystructureincome_sql = "SELECT 
    tblpaystructures.paystructure_id,
    tblpaystructures.paystructure_value,
    tblpayheads.payhead_id,
    tblpayheads.payhead_name,
    tblpayheads.payhead_desc,
    tblpayheads.payhead_type
    FROM tblpaystructures
    INNER JOIN tblpayheads ON tblpaystructures.payhead_id = tblpayheads.payhead_id WHERE tblpaystructures.employee_id = '$employeeid' AND tblpayheads.payhead_type ='EARNINGS' ORDER BY tblpayheads.payhead_id";

    $paystructureincome_result = mysqli_query($link, $paystructureincome_sql);
    if (!$paystructureincome_result) {
        die("Query failed: " . mysqli_error($link));
    }
    while ($row = mysqli_fetch_assoc($paystructureincome_result)) {
        if ($row['payhead_id'] == 1) {
            $pdf->Cell(90, 7, $row['payhead_name'], 1);
            $pdf->Cell(40, 7, "Days Present: " . $dayspresent, 1, 0, 'L');
            $basic_salary = ((floatval($row["paystructure_value"] / 28)) * $dayspresent);
            $basic_salary = sprintf("%.2f", $basic_salary);
            $pdf->Cell(60, 7, 'Php ' . number_format($basic_salary, 2), 1, 1, 'R');
        } elseif ($row['payhead_id'] == 2) {
            $pdf->Cell(90, 7, $row['payhead_name'], 1);
            $payamount = (((floatval($row["paystructure_value"]) / 28) / 8) * $overtimehours) * 1.3;
            $pdf->Cell(40, 7, "Overtime Hours: " . $payamount, 1, 0, 'L');
            $pdf->Cell(60, 7, 'Php ' . number_format($payamount, 2), 1, 1, 'R');
        } else {
            $pdf->Cell(130, 7, $row['payhead_name'], 1);
            $pdf->Cell(60, 7, 'Php ' . number_format($row['paystructure_value'], 2), 1, 1, 'R');
        }
    }



    $pdf->Ln(5);



    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(130, 7, 'DEDUCTION PARTICULARS', 1, 0, 'C');
    $pdf->Cell(60, 7, 'AMOUNT', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $paystructurededuction_sql = "SELECT 
    tblpaystructures.paystructure_id,
    tblpaystructures.paystructure_value,
    tblpayheads.payhead_id,
    tblpayheads.payhead_name,
    tblpayheads.payhead_desc,
    tblpayheads.payhead_type
    FROM tblpaystructures
    INNER JOIN tblpayheads ON tblpaystructures.payhead_id = tblpayheads.payhead_id WHERE tblpaystructures.employee_id = '$employeeid' AND tblpayheads.payhead_type ='DEDUCTIONS' ORDER BY tblpayheads.payhead_id";

    $paystructurededuction_result = mysqli_query($link, $paystructurededuction_sql);
    if (!$paystructurededuction_result) {
        die("Query failed: " . mysqli_error($link));
    }
    while ($row = mysqli_fetch_assoc($paystructurededuction_result)) {
        $pdf->Cell(130, 7, $row['payhead_name'], 1);
        $pdf->Cell(60, 7, 'Php ' . number_format($row['paystructure_value'], 2), 1, 1, 'R');
    }

    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(255, 223, 76);
    $pdf->Cell(130, 10, 'NET PAY', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Php ' . number_format($netpay, 2), 1, 1, 'R', true);







    $pdf->Output();

}

?>