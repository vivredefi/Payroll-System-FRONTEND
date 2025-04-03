<?php
if (isset($_POST["btnAdd"])) {
    require_once "config.php";
    include "session_checker_admin.php";
    if (isset($_POST['btnAdd'])) {
        $sql = "INSERT INTO tblemployees(employee_id, name, position, branch, createdby, datecreated) VALUES(?,?,?,?,?,NOW())";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $_POST['txtemployee_id'], $_POST['txtname'], $_POST['cmbposition'], $_POST['cmbbranch'], $_SESSION['username']);
            if (mysqli_stmt_execute($stmt)) {
                $sql = "INSERT INTO tbllogs(datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    $date = date("m/d/Y");
                    $time = date("h:i:s");
                    $action = "Add";
                    $module = "Employee Management";
                    mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['txtemployee_id'], $_SESSION['username']);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "Employee created";


                        // Add Pay Structures Basic Salary
                        // Get the latest ainumber
                        $sqlainumber = "SELECT MAX(paystructure_id) AS ainumber FROM tblpaystructures";
                        $resultainumber = mysqli_query($link, $sqlainumber);

                        $latestainumber = 0;

                        if ($row = mysqli_fetch_assoc($resultainumber)) {
                            $latestainumber = $row["ainumber"] + 1 ?? 0; // Default to 0 if null
                        }

                        // If there are no records, start from 1
                        if ($latestainumber == 0) {
                            $latestainumber = 1;
                        }
                        $payhead_id = 1;
                        $paystructure_value = 0;
                        $sql = "INSERT INTO tblpaystructures(employee_id, payhead_id, paystructure_value) VALUES(?,?,?)";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "sss", $_POST['txtemployee_id'], $payhead_id, $paystructure_value);
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
                                    } else {
                                        echo "<font color = 'red'>Error on loading on logs.</font>";
                                    }
                                }
                            }
                        }


                        // Add Pay Structures Overtime
                        // Get the latest ainumber
                        $sqlainumber = "SELECT MAX(paystructure_id) AS ainumber FROM tblpaystructures";
                        $resultainumber = mysqli_query($link, $sqlainumber);

                        $latestainumber = 0;

                        if ($row = mysqli_fetch_assoc($resultainumber)) {
                            $latestainumber = $row["ainumber"] + 1 ?? 0; // Default to 0 if null
                        }

                        // If there are no records, start from 1
                        if ($latestainumber == 0) {
                            $latestainumber = 1;
                        }
                        $payhead_id = 2;
                        $paystructure_value = 0;
                        $sql = "INSERT INTO tblpaystructures(employee_id, payhead_id, paystructure_value) VALUES(?,?,?)";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "sss", $_POST['txtemployee_id'], $payhead_id, $paystructure_value);
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
                                    } else {
                                        echo "<font color = 'red'>Error on loading on logs.</font>";
                                    }
                                }
                            }
                        }








                        $usertype = "";
                        if ($_POST['cmbposition'] == "ADMINISTRATOR") {
                            $usertype = "ADMINISTRATOR";
                        } else {
                            $usertype = "STAFF";
                        }
                        $sql = "INSERT INTO tblaccounts(username, userpass, usertype, userstatus, createdby, datecreated) VALUES(?,?,?,'ACTIVE',?,NOW())";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "ssss", $_POST['txtemployee_id'], $_POST['txtpassword'], $usertype, $_SESSION['username']);
                            if (mysqli_stmt_execute($stmt)) {
                                $sql = "INSERT INTO tbllogs(datelog, timelog, action, module, employee_id, performedby) VALUES(?,?,?,?,?,?)";
                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    $date = date("m/d/Y");
                                    $time = date("h:i:s");
                                    $action = "Add";
                                    $module = "Account Management";
                                    mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $action, $module, $_POST['txtemployee_id'], $_SESSION['username']);
                                    if (mysqli_stmt_execute($stmt)) {
                                        echo "Account created";
                                        $_SESSION['executionStatus'] = "Employee and Account Details Successfully Created";
                                        header(("location: employees-management.php"));
                                        exit();
                                    } else {
                                        echo "<font color = 'red'>Error on loading on logs.</font>";
                                    }
                                }
                            } else {
                                echo "<font color = 'red'>Error on adding new employee2.</font>";
                            }
                        }



                    } else {
                        echo "<font color = 'red'>Error on loading on logs.</font>";
                    }
                }
            } else {
                echo "<font color = 'red'>Error on adding new employee1.</font>";
            }
        } else {
            echo "<font color = 'red'>Error on adding new employee2.</font>";
        }

    } else {
        echo "<font color = 'red'>Error on adding new employee3.</font>";
    }
}

?>