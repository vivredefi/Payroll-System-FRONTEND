<?php class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'LAVYNETT LAUNDRY SHOP', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 10, 'PAYSLIP', 1, 1, 'C', true);
        $this->Ln(5);
    }
    
    function EmployeeDetails($name, $position, $payPeriod, $dailyRate) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 7, 'Employee Details', 1, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(95, 7, "Name: $name", 1,1);
        $this->Cell(95, 7, "Position: $position", 1);
        $this->Cell(95, 7, "Payroll Period: $payPeriod", 1, 1);
        $this->Cell(0, 7, "Daily Rate: Php $dailyRate", 1, 1);
        $this->Ln(5);
    }
    
    function IncomeTable($income) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 7, 'INCOME PARTICULARS', 1, 0, 'C');
        $this->Cell(30, 7, 'DAYS', 1, 0, 'C');
        $this->Cell(60, 7, 'AMOUNT', 1, 1, 'C');
        $this->SetFont('Arial', '', 10);
        foreach ($income as $item) {
            $this->Cell(100, 7, $item['name'], 1);
            $this->Cell(30, 7, $item['days'], 1, 0, 'C');
            $this->Cell(60, 7, 'Php ' . number_format($item['amount'], 2), 1, 1, 'R');
        }
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 7, 'TOTAL INCOME', 1);
        $this->Cell(60, 7, 'Php ' . number_format(array_sum(array_column($income, 'amount')), 2), 1, 1, 'R');
        $this->Ln(5);
    }
    
    function DeductionTable($deductions) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 7, 'DEDUCTION PARTICULARS', 1, 0, 'C');
        $this->Cell(60, 7, 'AMOUNT', 1, 1, 'C');
        $this->SetFont('Arial', '', 10);
        foreach ($deductions as $item) {
            $this->Cell(130, 7, $item['name'], 1);
            $this->Cell(60, 7, 'Php ' . number_format($item['amount'], 2), 1, 1, 'R');
        }
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 7, 'TOTAL DEDUCTIONS', 1);
        $this->Cell(60, 7, 'Php ' . number_format(array_sum(array_column($deductions, 'amount')), 2), 1, 1, 'R');
        $this->Ln(5);
    }
    
    function NetPay($income, $deductions) {
        $netPay = array_sum(array_column($income, 'amount')) - array_sum(array_column($deductions, 'amount'));
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(255, 223, 76);
        $this->Cell(130, 10, 'NET PAY', 1, 0, 'C', true);
        $this->Cell(60, 10, 'Php ' . number_format($netPay, 2), 1, 1, 'R', true);
        $this->Ln(10);
    }
}

$pdf = new PDF();
$pdf->AddPage();

$pdf->EmployeeDetails('MA.CRISTINA MAGSINO', 'LAUNDRY ATTENDANT', 'AUGUST 2025', 475);

$income = [
    ['name' => 'Basic Salary', 'days' => 12, 'amount' => 5700],
    ['name' => 'Cost of Living Allowance', 'days' => 12, 'amount' => 891],
    ['name' => 'Overtime Pay', 'days' => 12, 'amount' => 950],
    ['name' => 'Legal Holiday Pay', 'days' => 1, 'amount' => 594]
];
$pdf->IncomeTable($income);

$deductions = [
    ['name' => 'SSS Contribution', 'amount' => 473]
];
$pdf->DeductionTable($deductions);

$pdf->NetPay($income, $deductions);

$pdf->Output();

?>