-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 06:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `username` varchar(50) NOT NULL,
  `userpass` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `userstatus` varchar(50) NOT NULL,
  `createdby` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`username`, `userpass`, `usertype`, `userstatus`, `createdby`, `datecreated`) VALUES
('admin', '1234', 'ADMINISTRATOR', 'ACTIVE', 'admin', '01/17/2025'),
('EMP100021', '1234', 'STAFF', 'ACTIVE', 'admin', '2025-01-30 20:16:50'),
('EMP100022', '1234', 'STAFF', 'ACTIVE', 'admin', '2025-02-09 08:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `attendance_id` int(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `time_in` varchar(50) NOT NULL,
  `time_out` varchar(50) DEFAULT NULL,
  `hours_attended` varchar(50) DEFAULT NULL,
  `overtime_hours` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblattendance`
--

INSERT INTO `tblattendance` (`attendance_id`, `employee_id`, `time_in`, `time_out`, `hours_attended`, `overtime_hours`, `date`) VALUES
(1, 'EMP100021', '12:20:11', '00:45:36', '11', '3', '02/10/2025'),
(2, 'EMP100021', '12:32:10', '00:45:36', '11', '3', '02/10/2025'),
(3, 'EMP100021', '12:32:16', '00:45:36', '11', '3', '02/10/2025'),
(4, 'EMP100021', '12:37:38', '00:45:36', '11', '3', '02/10/2025'),
(5, 'EMP100022', '00:47:46', '00:48:06', '0', '0', '02/10/2025'),
(6, 'EMP100022', '18:31:49', '18:31:52', '25', '17', '02/13/2025'),
(7, 'EMP100022', '20:17:51', '20:18:19', '0', '0', '02/17/2025'),
(8, 'EMP100022', '04:38:46', '07:48:58', '3', '0', '02/27/2025'),
(9, 'EMP100022', '02:27:32', NULL, NULL, NULL, '02/28/2025'),
(10, 'EMP100022', '00:51:44', NULL, NULL, NULL, '03/07/2025'),
(11, 'EMP100022', '03:43:29', NULL, NULL, NULL, '03/08/2025'),
(12, 'EMP100022', '01:22:26', '01:27:23', '0', '0', '03/09/2025');

-- --------------------------------------------------------

--
-- Table structure for table `tblbranches`
--

CREATE TABLE `tblbranches` (
  `branchname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `createdby` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblbranches`
--

INSERT INTO `tblbranches` (`branchname`, `address`, `createdby`, `datecreated`) VALUES
('branch demo 1', 'navotas', 'admin', '2025-03-09 01:43:51'),
('branch demo 6', 'mabalacat', 'admin', '2025-03-09 01:42:52'),
('french', 'tondo', 'EMP100022', '2025-02-13 23:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `ainumber` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `dailyrate` varchar(50) NOT NULL,
  `createdby` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`ainumber`, `employee_id`, `name`, `position`, `branch`, `dailyrate`, `createdby`, `datecreated`) VALUES
(100021, 'EMP100021', 'gabayni', 'LAUNDRY ATTENDANT', 'Branch 2', '500', 'admin', '2025-01-30 20:16:50'),
(100022, 'EMP100022', 'deraya', 'LAUNDRY ATTENDANT', 'branch demo 1', '480', 'admin', '2025-02-09 08:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `leave_id` int(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `date_from` varchar(50) NOT NULL,
  `date_to` varchar(50) NOT NULL,
  `message` varchar(250) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`leave_id`, `employee_id`, `date_from`, `date_to`, `message`, `type`, `status`) VALUES
(7, 'EMP100022', '03/05/2025', '03/13/2025', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here', '', 'DECLINED'),
(9, 'EMP100021', '03/20/2025', '03/21/2025', '', '', 'APPROVED'),
(11, 'EMP100022', '03/20/2025', '03/28/2025', 'asdfasdfas', 'Casual Leave', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `datelog` varchar(50) NOT NULL,
  `timelog` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `performedby` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`datelog`, `timelog`, `action`, `module`, `employee_id`, `performedby`) VALUES
('1', '2', '0', '0', '0', '0'),
('1', '2', '0', '0', '0', '0'),
('1', '2', '0', '0', '0', '0'),
('1', '2', '0', '0', '0', '0'),
('1', '2', '0', '0', '0', '0'),
('1', '2', '0', '0', '0', '0'),
('01/26/2025', '08:48:36', 'Delete', 'Students Management', '', 'admin'),
('01/26/2025', '08:48:49', 'Delete', 'Students Management', '', 'admin'),
('01/26/2025', '08:49:24', 'Delete', 'Students Management', '', 'admin'),
('01/26/2025', '08:50:21', 'Delete', 'Students Management', '', 'admin'),
('01/26/2025', '08:51:41', 'Delete', 'Students Management', '', 'admin'),
('01/26/2025', '08:51:47', 'Delete', 'Students Management', '', 'admin'),
('01/26/2025', '08:52:57', 'Delete', 'Students Management', '', 'admin'),
('01/26/2025', '08:56:59', 'Delete', 'Students Management', 'EMP100001', 'admin'),
('01/27/2025', '12:28:44', 'Delete', 'Employees Management', 'EMP100018', 'admin'),
('01/27/2025', '11:29:51', 'Update', 'Account Management', 'EMP100018', 'admin'),
('01/27/2025', '11:30:11', 'Update', 'Account Management', 'EMP100018', 'admin'),
('01/30/2025', '12:21:08', 'Add', 'Account Management', 'branch demo 3', 'admin'),
('01/30/2025', '07:45:49', 'Delete', 'Branches Management', 'branch demo 2', 'admin'),
('01/30/2025', '07:46:02', 'Delete', 'Branches Management', 'branch demo 2', 'admin'),
('01/30/2025', '07:47:04', 'Delete', 'Branches Management', 'branch demo 2', 'admin'),
('01/30/2025', '07:48:07', 'Delete', 'Employees Management', 'EMP100017', 'admin'),
('01/30/2025', '07:48:07', 'Delete', 'Accounts Management', 'EMP100017', 'admin'),
('01/30/2025', '07:48:58', 'Delete', 'Employees Management', 'EMP100002', 'admin'),
('01/30/2025', '07:48:58', 'Delete', 'Accounts Management', 'EMP100002', 'admin'),
('01/30/2025', '07:49:02', 'Delete', 'Employees Management', 'EMP100003', 'admin'),
('01/30/2025', '07:49:02', 'Delete', 'Accounts Management', 'EMP100003', 'admin'),
('01/30/2025', '07:49:03', 'Delete', 'Employees Management', 'EMP100005', 'admin'),
('01/30/2025', '07:49:03', 'Delete', 'Accounts Management', 'EMP100005', 'admin'),
('01/30/2025', '07:49:06', 'Delete', 'Employees Management', 'EMP100006', 'admin'),
('01/30/2025', '07:49:06', 'Delete', 'Accounts Management', 'EMP100006', 'admin'),
('01/30/2025', '07:49:08', 'Delete', 'Employees Management', 'EMP100008', 'admin'),
('01/30/2025', '07:49:08', 'Delete', 'Accounts Management', 'EMP100008', 'admin'),
('01/30/2025', '07:49:11', 'Delete', 'Employees Management', 'EMP100011', 'admin'),
('01/30/2025', '07:49:11', 'Delete', 'Accounts Management', 'EMP100011', 'admin'),
('01/30/2025', '07:49:14', 'Delete', 'Employees Management', 'EMP100012', 'admin'),
('01/30/2025', '07:49:14', 'Delete', 'Accounts Management', 'EMP100012', 'admin'),
('01/30/2025', '07:49:16', 'Delete', 'Employees Management', 'EMP100014', 'admin'),
('01/30/2025', '07:49:16', 'Delete', 'Accounts Management', 'EMP100014', 'admin'),
('01/30/2025', '07:49:18', 'Delete', 'Employees Management', 'EMP100015', 'admin'),
('01/30/2025', '07:49:18', 'Delete', 'Accounts Management', 'EMP100015', 'admin'),
('01/30/2025', '07:49:21', 'Delete', 'Employees Management', 'EMP100016', 'admin'),
('01/30/2025', '07:49:21', 'Delete', 'Accounts Management', 'EMP100016', 'admin'),
('01/30/2025', '08:00:11', 'Add', 'Employee Management', 'EMP100001', 'admin'),
('01/30/2025', '08:00:11', 'Add', 'Account Management', 'EMP100001', 'admin'),
('01/30/2025', '08:15:57', 'Add', 'Employee Management', 'EMP100020', 'admin'),
('01/30/2025', '08:15:57', 'Add', 'Account Management', 'EMP100020', 'admin'),
('01/30/2025', '08:16:50', 'Add', 'Employee Management', 'EMP100021', 'admin'),
('01/30/2025', '08:16:50', 'Add', 'Account Management', 'EMP100021', 'admin'),
('01/30/2025', '08:20:04', 'Delete', 'Employees Management', 'EMP100020', 'admin'),
('01/30/2025', '08:20:04', 'Delete', 'Accounts Management', 'EMP100020', 'admin'),
('02/06/2025', '10:11:13', 'Update', 'Employees Management', 'EMP100021', 'EMP100021'),
('02/10/2025', '12:46:58', 'Add', 'Employee Management', 'EMP100022', 'admin'),
('02/10/2025', '12:46:58', 'Add', 'Account Management', 'EMP100022', 'admin'),
('02/13/2025', '11:09:36', 'Delete', 'Branches Management', 'branch demo 1', 'EMP100022'),
('02/13/2025', '11:09:39', 'Delete', 'Branches Management', 'branch demo 3', 'EMP100022'),
('02/13/2025', '11:09:54', 'Add', 'Account Management', 'branch demo 1', 'EMP100022'),
('02/13/2025', '11:10:30', 'Add', 'Account Management', 'branch demo 2', 'EMP100022'),
('02/13/2025', '11:11:51', 'Add', 'Account Management', 'french', 'EMP100022'),
('02/28/2025', '03:27:23', 'Add', 'Leave Management', 'EMP100022', 'EMP100022'),
('02/28/2025', '03:28:01', 'Add', 'Leave Management', 'EMP100022', 'EMP100022'),
('02/28/2025', '03:29:07', 'Add', 'Leave Management', 'EMP100022', 'EMP100022'),
('02/28/2025', '03:37:24', 'Add', 'Leave Management', 'EMP100022', 'EMP100022'),
('03/03/2025', '07:29:01', 'Delete', 'Leave Management', '1', 'EMP100022'),
('03/03/2025', '07:29:28', 'Delete', 'Leave Management', '1', 'EMP100022'),
('03/03/2025', '07:30:22', 'Delete', 'Leave Management', '1', 'EMP100022'),
('03/03/2025', '07:30:39', 'Delete', 'Leave Management', '1', 'EMP100022'),
('03/03/2025', '07:30:57', 'Delete', 'Leave Management', '1', 'EMP100022'),
('03/03/2025', '07:31:44', 'Delete', 'Leave Management', '5', 'EMP100022'),
('03/03/2025', '07:32:20', 'Delete', 'Leave Management', '5', 'EMP100022'),
('03/03/2025', '07:32:27', 'Delete', 'Leave Management', '', 'EMP100022'),
('03/03/2025', '07:37:24', 'Delete', 'Leave Management', '', 'EMP100022'),
('03/03/2025', '07:37:45', 'Add', 'Leave Management', 'EMP100022', 'EMP100022'),
('03/03/2025', '07:39:12', 'Delete', 'Leave Management', '6', 'EMP100022'),
('03/03/2025', '07:43:36', 'Add', 'Leave Management', 'EMP100022', 'EMP100022'),
('03/04/2025', '12:27:55', 'Add', 'Leave Management', 'EMP100021', 'EMP100021'),
('03/04/2025', '12:28:10', 'Delete', 'Leave Management', '8', 'EMP100021'),
('03/04/2025', '12:28:22', 'Add', 'Leave Management', 'EMP100021', 'EMP100021'),
('03/04/2025', '01:49:42', 'Add', 'Leave Management', 'EMP100021', 'EMP100021'),
('03/04/2025', '01:49:51', 'Delete', 'Leave Management', '10', 'EMP100021'),
('03/07/2025', '12:49:48', 'Update', 'Leave Management', '7', 'admin'),
('03/07/2025', '12:50:39', 'Update', 'Leave Management', '9', 'admin'),
('03/07/2025', '12:50:44', 'Update', 'Leave Management', '9', 'admin'),
('03/07/2025', '12:51:03', 'Update', 'Leave Management', '7', 'admin'),
('03/07/2025', '12:51:06', 'Update', 'Leave Management', '7', 'admin'),
('03/07/2025', '12:52:08', 'Add', 'Leave Management', 'EMP100022', 'EMP100022'),
('03/09/2025', '01:42:52', 'Add', 'Account Management', 'branch demo 6', 'admin'),
('03/09/2025', '01:43:33', 'Delete', 'Branches Management', 'branch demo 1', 'admin'),
('03/09/2025', '01:43:37', 'Delete', 'Branches Management', 'branch demo 2', 'admin'),
('03/09/2025', '01:43:51', 'Add', 'Account Management', 'branch demo 1', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_monthly_attendance`
-- (See below for the actual view)
--
CREATE TABLE `view_monthly_attendance` (
`employee_id` varchar(50)
,`name` varchar(50)
,`monthyear` varchar(7)
,`total_hours_attended` double
,`total_overtime` double
,`days_present` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `view_monthly_attendance`
--
DROP TABLE IF EXISTS `view_monthly_attendance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_monthly_attendance`  AS SELECT `a`.`employee_id` AS `employee_id`, `e`.`name` AS `name`, date_format(str_to_date(`a`.`date`,'%m/%d/%Y'),'%m/%Y') AS `monthyear`, sum(`a`.`hours_attended`) AS `total_hours_attended`, sum(`a`.`overtime_hours`) AS `total_overtime`, count(`a`.`date`) AS `days_present` FROM (`tblattendance` `a` join `tblemployees` `e` on(`a`.`employee_id` = `e`.`employee_id`)) GROUP BY `a`.`employee_id`, `e`.`name`, date_format(str_to_date(`a`.`date`,'%m/%d/%Y'),'%m/%Y') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tblbranches`
--
ALTER TABLE `tblbranches`
  ADD PRIMARY KEY (`branchname`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `ainumber` (`ainumber`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`leave_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `attendance_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `ainumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100023;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `leave_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
