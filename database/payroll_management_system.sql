-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 01:03 PM
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
('EMP100022', '1234', 'STAFF', 'ACTIVE', 'admin', '2025-02-09 08:46:58'),
('EMP100023', '123456', 'STAFF', 'ACTIVE', 'admin', '2025-03-24 12:02:21'),
('EMP100024', '123456', 'STAFF', 'ACTIVE', 'admin', '2025-03-24 12:03:11'),
('EMP100025', '1234', 'STAFF', 'ACTIVE', 'admin', '2025-03-30 04:38:06');

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
-- Table structure for table `tbldeductions`
--

CREATE TABLE `tbldeductions` (
  `deduction_id` int(50) NOT NULL,
  `deduction_name` varchar(50) NOT NULL,
  `deduction_desc` varchar(50) DEFAULT NULL,
  `deduction_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(100021, 'EMP100021', 'gabayni', 'LAUNDRY ATTENDANT', 'branch demo 6', '500', 'admin', '2025-01-30 20:16:50'),
(100022, 'EMP100022', 'deraya', 'LAUNDRY ATTENDANT', 'branch demo 1', '480', 'admin', '2025-02-09 08:46:58'),
(100023, 'EMP100023', 'kane', 'LAUNDRY ATTENDANT', 'branch demo 1', '', 'admin', '2025-03-24 12:02:21'),
(100024, 'EMP100024', 'althea', 'LAUNDRY ATTENDANT', 'french', '', 'admin', '2025-03-24 12:03:11'),
(100025, 'EMP100025', 'deraya, knives', 'LAUNDRY ATTENDANT', 'branch demo 1', '', 'admin', '2025-03-30 04:38:05');

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
(11, 'EMP100022', '03/20/2025', '03/28/2025', 'asdfasdfas', 'Casual Leave', 'APPROVED');

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
('03/09/2025', '01:43:51', 'Add', 'Account Management', 'branch demo 1', 'admin'),
('03/11/2025', '11:04:07', 'Update', 'Account Management', 'EMP100022', 'admin'),
('03/12/2025', '02:46:02', 'Update', 'Employees Management', 'EMP100021', 'admin'),
('03/13/2025', '05:19:36', 'Update', 'Leave Management', '11', 'admin'),
('03/17/2025', '10:29:22', 'Add', 'Account Management', '', 'admin'),
('03/17/2025', '10:32:25', 'Add', 'Payhead Management', '', 'admin'),
('03/17/2025', '10:37:29', 'Add', 'Payhead Management', '7', 'admin'),
('03/17/2025', '12:37:55', 'Update', 'Pay Head Management', '1', 'admin'),
('03/17/2025', '12:43:06', 'Delete', 'Payheads Management', '7', 'admin'),
('03/18/2025', '06:07:21', 'Add', 'Pay Structure Management', '3', 'admin'),
('03/18/2025', '06:10:23', 'Add', 'Pay Structure Management', '4', 'admin'),
('03/18/2025', '06:14:02', 'Add', 'Pay Structure Management', '5', 'admin'),
('03/18/2025', '06:14:54', 'Add', 'Pay Structure Management', '6', 'admin'),
('03/18/2025', '06:26:38', 'Add', 'Pay Structure Management', '7', 'admin'),
('03/18/2025', '06:28:16', 'Add', 'Pay Structure Management', '8', 'admin'),
('03/24/2025', '11:26:17', 'Update', 'Pay Head Management', '1', 'admin'),
('03/24/2025', '11:27:37', 'Update', 'Pay Head Management', '1', 'admin'),
('03/24/2025', '11:32:41', 'Add', 'Pay Structure Management', '9', 'admin'),
('03/24/2025', '11:52:15', 'Add', 'Account Management', 'EMP100023', 'admin'),
('03/24/2025', '11:55:53', 'Delete', 'Employees Management', 'EMP100023', 'admin'),
('03/24/2025', '11:55:53', 'Delete', 'Accounts Management', 'EMP100023', 'admin'),
('03/24/2025', '11:56:13', 'Add', 'Account Management', 'EMP100023', 'admin'),
('03/24/2025', '11:58:33', 'Delete', 'Employees Management', 'EMP100023', 'admin'),
('03/24/2025', '11:58:33', 'Delete', 'Accounts Management', 'EMP100023', 'admin'),
('03/24/2025', '12:02:21', 'Add', 'Employee Management', 'EMP100023', 'admin'),
('03/24/2025', '12:02:21', 'Add', 'Account Management', 'EMP100023', 'admin'),
('03/24/2025', '12:03:11', 'Add', 'Employee Management', 'EMP100024', 'admin'),
('03/24/2025', '12:03:11', 'Add', 'Account Management', 'EMP100024', 'admin'),
('03/25/2025', '06:43:06', 'Add', 'Pay Structure Management', '10', 'admin'),
('03/25/2025', '06:43:22', 'Add', 'Pay Structure Management', '11', 'admin'),
('03/25/2025', '07:17:09', 'Add', 'Payhead Management', '7', 'admin'),
('03/25/2025', '07:17:48', 'Add', 'Pay Structures Management', '12', 'admin'),
('03/25/2025', '07:28:21', 'Delete', 'Pay Structures Management', '12', 'admin'),
('03/27/2025', '07:58:02', 'Delete', 'Pay Structures Management', '3', 'admin'),
('03/27/2025', '08:02:43', 'Delete', 'Pay Structures Management', '7', 'admin'),
('03/27/2025', '08:52:34', 'Update', 'Pay Structures Management', '2', 'admin'),
('03/27/2025', '08:56:06', 'Delete', 'Pay Structures Management', '4', 'admin'),
('03/27/2025', '08:58:58', 'Delete', 'Pay Structures Management', '5', 'admin'),
('03/27/2025', '09:00:51', 'Delete', 'Pay Structures Management', '6', 'admin'),
('03/27/2025', '09:01:12', 'Delete', 'Pay Structures Management', '6', 'admin'),
('03/27/2025', '09:04:34', 'Delete', 'Pay Structures Management', '6', 'admin'),
('03/27/2025', '09:04:49', 'Add', 'Pay Structures Management', '12', 'admin'),
('03/27/2025', '09:04:54', 'Delete', 'Pay Structures Management', '13', 'admin'),
('03/27/2025', '09:06:37', 'Add', 'Pay Structures Management', '12', 'admin'),
('03/27/2025', '09:06:58', 'Add', 'Pay Structures Management', '15', 'admin'),
('03/27/2025', '09:07:09', 'Delete', 'Pay Structures Management', '15', 'admin'),
('03/27/2025', '09:08:44', 'Delete', 'Pay Structures Management', '14', 'admin'),
('03/27/2025', '09:09:00', 'Add', 'Pay Structures Management', '12', 'admin'),
('03/27/2025', '09:09:09', 'Delete', 'Pay Structures Management', '16', 'admin'),
('03/27/2025', '09:14:28', 'Update', 'Pay Structures Management', '9', 'admin'),
('03/27/2025', '09:14:42', 'Delete', 'Pay Structures Management', '9', 'admin'),
('03/27/2025', '09:15:04', 'Add', 'Pay Structures Management', '12', 'admin'),
('03/27/2025', '09:15:14', 'Add', 'Pay Structures Management', '18', 'admin'),
('03/27/2025', '09:15:20', 'Delete', 'Pay Structures Management', '18', 'admin'),
('03/27/2025', '09:17:04', 'Update', 'Pay Structures Management', '17', 'admin'),
('03/27/2025', '09:19:35', 'Add', 'Pay Structures Management', '18', 'admin'),
('03/27/2025', '09:19:44', 'Delete', 'Pay Structures Management', '19', 'admin'),
('03/27/2025', '09:20:06', 'Add', 'Pay Structures Management', '18', 'admin'),
('03/27/2025', '09:20:19', 'Update', 'Pay Structures Management', '20', 'admin'),
('03/27/2025', '09:24:42', 'Update', 'Pay Structures Management', '20', 'admin'),
('03/27/2025', '09:24:51', 'Delete', 'Pay Structures Management', '20', 'admin'),
('03/27/2025', '09:25:21', 'Add', 'Pay Structures Management', '18', 'admin'),
('03/27/2025', '09:28:15', 'Add', 'Pay Structures Management', '22', 'admin'),
('03/27/2025', '09:28:22', 'Delete', 'Pay Structures Management', '21', 'admin'),
('03/27/2025', '09:29:10', 'Delete', 'Pay Structures Management', '22', 'admin'),
('03/27/2025', '09:29:24', 'Add', 'Pay Structures Management', '18', 'admin'),
('03/27/2025', '09:29:29', 'Delete', 'Pay Structures Management', '23', 'admin'),
('03/27/2025', '09:34:54', 'Update', 'Pay Structures Management', '2', 'admin'),
('03/27/2025', '09:34:59', 'Update', 'Pay Structures Management', '2', 'admin'),
('03/27/2025', '09:38:39', 'Add', 'Pay Structures Management', '18', 'admin'),
('03/27/2025', '09:38:49', 'Update', 'Pay Structures Management', '24', 'admin'),
('03/27/2025', '09:41:03', 'Update', 'Pay Structures Management', '24', 'admin'),
('03/27/2025', '09:41:06', 'Update', 'Pay Structures Management', '24', 'admin'),
('03/27/2025', '09:42:42', 'Update', 'Pay Structures Management', '24', 'admin'),
('03/27/2025', '09:42:46', 'Update', 'Pay Structures Management', '24', 'admin'),
('03/27/2025', '09:48:34', 'Add', 'Pay Structures Management', '25', 'admin'),
('03/27/2025', '09:48:46', 'Add', 'Pay Structures Management', '26', 'admin'),
('03/27/2025', '09:48:57', 'Update', 'Pay Structures Management', '2', 'admin'),
('03/27/2025', '09:49:02', 'Update', 'Pay Structures Management', '2', 'admin'),
('03/27/2025', '09:49:22', 'Update', 'Pay Structures Management', '2', 'admin'),
('03/27/2025', '09:49:32', 'Delete', 'Pay Structures Management', '25', 'admin'),
('03/27/2025', '09:49:36', 'Delete', 'Pay Structures Management', '24', 'admin'),
('03/27/2025', '11:39:04', 'Add', 'Pay Structures Management', '1', 'admin'),
('03/27/2025', '11:39:30', 'Add', 'Pay Structures Management', '2', 'admin'),
('03/27/2025', '11:40:01', 'Add', 'Pay Structures Management', '3', 'admin'),
('03/27/2025', '11:40:11', 'Update', 'Pay Structures Management', '3', 'admin'),
('03/30/2025', '04:38:06', 'Add', 'Employee Management', 'EMP100025', 'admin'),
('03/30/2025', '04:38:06', 'Add', 'Pay Structures Management', '4', 'admin'),
('03/30/2025', '04:38:06', 'Add', 'Pay Structures Management', '5', 'admin'),
('03/30/2025', '04:38:06', 'Add', 'Account Management', 'EMP100025', 'admin'),
('04/03/2025', '05:54:48', 'Update', 'Pay Head Management', '3', 'admin'),
('04/03/2025', '05:54:53', 'Update', 'Pay Head Management', '4', 'admin'),
('04/03/2025', '05:55:00', 'Delete', 'Payheads Management', '5', 'admin'),
('04/03/2025', '05:55:04', 'Delete', 'Payheads Management', '6', 'admin'),
('04/03/2025', '05:55:10', 'Update', 'Pay Head Management', '8', 'admin'),
('04/03/2025', '05:55:40', 'Update', 'Pay Head Management', '3', 'admin'),
('04/03/2025', '05:55:53', 'Update', 'Pay Head Management', '4', 'admin'),
('04/03/2025', '05:56:03', 'Update', 'Pay Head Management', '3', 'admin'),
('04/03/2025', '05:56:22', 'Update', 'Pay Head Management', '8', 'admin'),
('04/03/2025', '05:56:44', 'Update', 'Pay Head Management', '8', 'admin'),
('04/03/2025', '05:56:51', 'Update', 'Pay Head Management', '3', 'admin'),
('04/03/2025', '05:57:06', 'Update', 'Pay Head Management', '4', 'admin'),
('04/03/2025', '05:58:06', 'Add', 'Pay Structures Management', '6', 'admin'),
('04/03/2025', '06:06:07', 'Add', 'Payhead Management', '9', 'admin'),
('04/03/2025', '06:06:28', 'Add', 'Pay Structures Management', '7', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayheads`
--

CREATE TABLE `tblpayheads` (
  `payhead_id` int(50) NOT NULL,
  `payhead_name` varchar(50) NOT NULL,
  `payhead_desc` varchar(250) NOT NULL,
  `payhead_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayheads`
--

INSERT INTO `tblpayheads` (`payhead_id`, `payhead_name`, `payhead_desc`, `payhead_type`) VALUES
(1, 'Basic Salary', 'Basic Salary of an Employee per Month', 'EARNINGS'),
(2, 'Overtime Pay', 'Overtime Pay of an Employee based on overtime hour', 'EARNINGS'),
(3, 'PhilHealth', 'PhilHealth Deduction', 'DEDUCTIONS'),
(4, 'SSS', 'SSS deduction', 'DEDUCTIONS'),
(8, 'PAG-IBIG', 'PAG-IBIG Deduction', 'DEDUCTIONS'),
(9, 'Fare Allowance', 'For commuting', 'EARNINGS');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayslips`
--

CREATE TABLE `tblpayslips` (
  `payslip_id` int(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gross_pay` varchar(50) NOT NULL,
  `total_deductions` varchar(50) NOT NULL,
  `net_pay` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayslips`
--

INSERT INTO `tblpayslips` (`payslip_id`, `employee_id`, `name`, `gross_pay`, `total_deductions`, `net_pay`, `month`, `year`, `datecreated`) VALUES
(5, 'EMP100022', 'deraya', '1035.71', '-300.00', '735.71', '03', '2025', '04/03/202506:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblpaystructures`
--

CREATE TABLE `tblpaystructures` (
  `paystructure_id` int(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `payhead_id` int(50) NOT NULL,
  `paystructure_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpaystructures`
--

INSERT INTO `tblpaystructures` (`paystructure_id`, `employee_id`, `payhead_id`, `paystructure_value`) VALUES
(1, 'EMP100022', 1, '5000'),
(2, 'EMP100022', 2, '1000'),
(3, 'EMP100022', 4, '100'),
(4, 'EMP100025', 1, '0'),
(5, 'EMP100025', 2, '0'),
(6, 'EMP100022', 8, '200'),
(7, 'EMP100022', 9, '500');

-- --------------------------------------------------------

--
-- Table structure for table `tblsalaries`
--

CREATE TABLE `tblsalaries` (
  `salary_id` int(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `payhead_id` int(50) NOT NULL,
  `pay_amount` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsalaries`
--

INSERT INTO `tblsalaries` (`salary_id`, `employee_id`, `payhead_id`, `pay_amount`, `month`, `year`, `datecreated`) VALUES
(1, 'EMP100022', 1, '0', '01', '2025', '03/27/202507:54:36'),
(2, 'EMP100022', 2, '0', '01', '2025', '03/27/202507:54:36'),
(3, 'EMP100022', 2, '0', '01', '2025', '03/27/202507:54:36'),
(4, 'EMP100022', 5, '-300', '01', '2025', '03/27/202507:54:36'),
(5, 'EMP100022', 3, '-3000', '01', '2025', '03/27/202507:54:36'),
(6, 'EMP100022', 4, '-5000', '01', '2025', '03/27/202507:54:36'),
(7, 'EMP100022', 6, '-10000', '01', '2025', '03/27/202507:54:36'),
(8, 'EMP100022', 1, '0', '03', '2025', '03/27/202511:40:35'),
(9, 'EMP100022', 2, '0', '03', '2025', '03/27/202511:40:35'),
(10, 'EMP100022', 4, '-100', '03', '2025', '03/27/202511:40:35'),
(11, 'EMP100022', 1, '0', '01', '2025', '03/27/202511:41:48'),
(12, 'EMP100022', 2, '0', '01', '2025', '03/27/202511:41:48'),
(13, 'EMP100022', 4, '-100', '01', '2025', '03/27/202511:41:48'),
(14, 'EMP100022', 1, '0', '01', '2025', '03/27/202511:42:23'),
(15, 'EMP100022', 2, '0', '01', '2025', '03/27/202511:42:23'),
(16, 'EMP100022', 4, '-100', '01', '2025', '03/27/202511:42:23'),
(17, 'EMP100022', 1, '0', '03', '2025', '03/27/202511:44:59'),
(18, 'EMP100022', 2, '0', '03', '2025', '03/27/202511:44:59'),
(19, 'EMP100022', 4, '-100', '03', '2025', '03/27/202511:44:59'),
(20, 'EMP100022', 1, '535.71428571429', '03', '2025', '03/27/202511:47:39'),
(21, 'EMP100022', 2, '0', '03', '2025', '03/27/202511:47:39'),
(22, 'EMP100022', 4, '-100', '03', '2025', '03/27/202511:47:39'),
(23, 'EMP100022', 1, '892.85714285714', '02', '2025', '03/27/202511:52:01'),
(24, 'EMP100022', 2, '22.767857142857', '02', '2025', '03/27/202511:52:01'),
(25, 'EMP100022', 4, '-100', '02', '2025', '03/27/202511:52:01'),
(26, 'EMP100022', 1, '0.00', '01', '2025', '04/03/202502:44:58'),
(27, 'EMP100022', 2, '0', '01', '2025', '04/03/202502:44:58'),
(28, 'EMP100022', 4, '-100', '01', '2025', '04/03/202502:44:58'),
(29, 'EMP100022', 1, '0.00', '01', '2025', '04/03/202502:45:22'),
(30, 'EMP100022', 2, '0', '01', '2025', '04/03/202502:45:22'),
(31, 'EMP100022', 4, '-100', '01', '2025', '04/03/202502:45:22'),
(32, 'EMP100022', 1, '0.00', '01', '2025', '04/03/202502:46:21'),
(33, 'EMP100022', 2, '0', '01', '2025', '04/03/202502:46:21'),
(34, 'EMP100022', 4, '-100', '01', '2025', '04/03/202502:46:21'),
(35, 'EMP100022', 1, '535.71', '03', '2025', '04/03/202502:48:15'),
(36, 'EMP100022', 2, '0', '03', '2025', '04/03/202502:48:15'),
(37, 'EMP100022', 4, '-100', '03', '2025', '04/03/202502:48:15'),
(38, 'EMP100022', 1, '535.71', '03', '2025', '04/03/202505:52:33'),
(39, 'EMP100022', 2, '0', '03', '2025', '04/03/202505:52:33'),
(40, 'EMP100022', 4, '-100', '03', '2025', '04/03/202505:52:33'),
(41, 'EMP100022', 1, '0.00', '01', '2025', '04/03/202505:58:30'),
(42, 'EMP100022', 2, '0', '01', '2025', '04/03/202505:58:30'),
(43, 'EMP100022', 4, '-100', '01', '2025', '04/03/202505:58:30'),
(44, 'EMP100022', 8, '-200', '01', '2025', '04/03/202505:58:30'),
(45, 'EMP100022', 1, '535.71', '03', '2025', '04/03/202505:59:42'),
(46, 'EMP100022', 2, '0', '03', '2025', '04/03/202505:59:42'),
(47, 'EMP100022', 4, '-100', '03', '2025', '04/03/202505:59:42'),
(48, 'EMP100022', 8, '-200', '03', '2025', '04/03/202505:59:42'),
(49, 'EMP100022', 1, '535.71', '03', '2025', '04/03/202506:11:16'),
(50, 'EMP100022', 2, '0', '03', '2025', '04/03/202506:11:16'),
(51, 'EMP100022', 4, '-100', '03', '2025', '04/03/202506:11:16'),
(52, 'EMP100022', 8, '-200', '03', '2025', '04/03/202506:11:16'),
(53, 'EMP100022', 9, '500', '03', '2025', '04/03/202506:11:16');

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
-- Stand-in structure for view `vw_monthly_attendance`
-- (See below for the actual view)
--
CREATE TABLE `vw_monthly_attendance` (
`employee_id` varchar(50)
,`name` varchar(50)
,`month` varchar(2)
,`year` varchar(4)
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

-- --------------------------------------------------------

--
-- Structure for view `vw_monthly_attendance`
--
DROP TABLE IF EXISTS `vw_monthly_attendance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_monthly_attendance`  AS SELECT `a`.`employee_id` AS `employee_id`, `e`.`name` AS `name`, date_format(str_to_date(`a`.`date`,'%m/%d/%Y'),'%m') AS `month`, date_format(str_to_date(`a`.`date`,'%m/%d/%Y'),'%Y') AS `year`, sum(`a`.`hours_attended`) AS `total_hours_attended`, sum(`a`.`overtime_hours`) AS `total_overtime`, count(`a`.`date`) AS `days_present` FROM (`tblattendance` `a` join `tblemployees` `e` on(`a`.`employee_id` = `e`.`employee_id`)) GROUP BY `a`.`employee_id`, `e`.`name`, date_format(str_to_date(`a`.`date`,'%m/%d/%Y'),'%m'), date_format(str_to_date(`a`.`date`,'%m/%d/%Y'),'%Y') ;

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
-- Indexes for table `tbldeductions`
--
ALTER TABLE `tbldeductions`
  ADD PRIMARY KEY (`deduction_id`);

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
-- Indexes for table `tblpayheads`
--
ALTER TABLE `tblpayheads`
  ADD PRIMARY KEY (`payhead_id`);

--
-- Indexes for table `tblpayslips`
--
ALTER TABLE `tblpayslips`
  ADD PRIMARY KEY (`payslip_id`);

--
-- Indexes for table `tblpaystructures`
--
ALTER TABLE `tblpaystructures`
  ADD PRIMARY KEY (`paystructure_id`);

--
-- Indexes for table `tblsalaries`
--
ALTER TABLE `tblsalaries`
  ADD PRIMARY KEY (`salary_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `attendance_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbldeductions`
--
ALTER TABLE `tbldeductions`
  MODIFY `deduction_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `ainumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100026;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `leave_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblpayheads`
--
ALTER TABLE `tblpayheads`
  MODIFY `payhead_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblpayslips`
--
ALTER TABLE `tblpayslips`
  MODIFY `payslip_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpaystructures`
--
ALTER TABLE `tblpaystructures`
  MODIFY `paystructure_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblsalaries`
--
ALTER TABLE `tblsalaries`
  MODIFY `salary_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
