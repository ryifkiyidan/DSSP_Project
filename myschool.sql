-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 11:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birth_date` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`first_name`, `last_name`, `gender`, `birth_date`, `username`, `password`) VALUES
('Wijayanto', 'Gunawan', 'Male', '1970-11-13', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(18) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birth_date` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `first_name`, `last_name`, `gender`, `birth_date`, `username`, `password`) VALUES
('197201312003042117', 'Sri', 'Yani', 'Female', '1972-01-31', 'sri.yani', '77e69c137812518e359196bb2f5e9bb9'),
('197205252001032201', 'Linda', 'Rumawangun', 'Female', '1972-05-25', 'linda.rumawangun', '77e69c137812518e359196bb2f5e9bb9'),
('197501212001032288', 'Hartanto', 'Hachiman', 'Male', '1975-01-21', 'hartanto.hachiman', '77e69c137812518e359196bb2f5e9bb9'),
('197506252002052111', 'Lickie', 'Bientant', 'Female', '1975-06-25', 'lickie.bientant', '77e69c137812518e359196bb2f5e9bb9'),
('198009092006100131', 'Rama', 'Fitriyanto', 'Male', '1980-09-09', 'rama.fitriyanto', '77e69c137812518e359196bb2f5e9bb9'),
('198202102008020166', 'Amdayon', 'Bahar', 'Male', '1982-02-10', 'amdayon.bahar', '77e69c137812518e359196bb2f5e9bb9'),
('198612042010011722', 'Seto', 'Makmur', 'Male', '1986-12-04', 'seto.makmur', '77e69c137812518e359196bb2f5e9bb9');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` varchar(6) NOT NULL,
  `name` varchar(10) NOT NULL,
  `tahun_ajaran` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `name`, `tahun_ajaran`) VALUES
('KS0001', '9A', 2019),
('KS0002', '9B', 2019),
('KS0003', '8A', 2019),
('KS0004', '8B', 2019),
('KS0005', '7A', 2019),
('KS0006', '7B', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` varchar(6) NOT NULL,
  `matpelID` varchar(6) NOT NULL,
  `guruNIP` varchar(18) NOT NULL,
  `kelasID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id`, `matpelID`, `guruNIP`, `kelasID`) VALUES
('LS0001', 'MP0001', '198202102008020166', 'KS0005'),
('LS0002', 'MP0001', '198202102008020166', 'KS0006'),
('LS0003', 'MP0001', '198202102008020166', 'KS0003'),
('LS0004', 'MP0001', '198202102008020166', 'KS0004'),
('LS0005', 'MP0001', '198202102008020166', 'KS0001'),
('LS0006', 'MP0001', '198202102008020166', 'KS0002'),
('LS0007', 'MP0002', '197501212001032288', 'KS0005'),
('LS0008', 'MP0002', '197501212001032288', 'KS0006'),
('LS0009', 'MP0002', '197501212001032288', 'KS0003'),
('LS0010', 'MP0002', '197501212001032288', 'KS0004'),
('LS0011', 'MP0002', '197501212001032288', 'KS0001'),
('LS0012', 'MP0002', '197501212001032288', 'KS0002'),
('LS0013', 'MP0003', '197506252002052111', 'KS0005'),
('LS0014', 'MP0003', '197506252002052111', 'KS0006'),
('LS0015', 'MP0003', '197506252002052111', 'KS0003'),
('LS0016', 'MP0003', '197506252002052111', 'KS0004'),
('LS0017', 'MP0003', '197506252002052111', 'KS0001'),
('LS0018', 'MP0003', '197506252002052111', 'KS0002'),
('LS0019', 'MP0006', '197205252001032201', 'KS0005'),
('LS0020', 'MP0006', '197205252001032201', 'KS0006'),
('LS0021', 'MP0006', '197205252001032201', 'KS0003'),
('LS0022', 'MP0006', '197205252001032201', 'KS0004'),
('LS0023', 'MP0006', '197205252001032201', 'KS0001'),
('LS0024', 'MP0006', '197205252001032201', 'KS0002'),
('LS0025', 'MP0004', '198009092006100131', 'KS0005'),
('LS0026', 'MP0004', '198009092006100131', 'KS0006'),
('LS0027', 'MP0004', '198009092006100131', 'KS0003'),
('LS0028', 'MP0004', '198009092006100131', 'KS0004'),
('LS0029', 'MP0004', '198009092006100131', 'KS0001'),
('LS0030', 'MP0004', '198009092006100131', 'KS0002'),
('LS0031', 'MP0005', '198612042010011722', 'KS0005'),
('LS0032', 'MP0005', '198612042010011722', 'KS0006'),
('LS0033', 'MP0005', '198612042010011722', 'KS0003'),
('LS0034', 'MP0005', '198612042010011722', 'KS0004'),
('LS0035', 'MP0005', '198612042010011722', 'KS0001'),
('LS0036', 'MP0005', '198612042010011722', 'KS0002'),
('LS0037', 'MP0007', '197201312003042117', 'KS0005'),
('LS0038', 'MP0007', '197201312003042117', 'KS0006'),
('LS0039', 'MP0007', '197201312003042117', 'KS0003'),
('LS0040', 'MP0007', '197201312003042117', 'KS0004'),
('LS0041', 'MP0007', '197201312003042117', 'KS0001'),
('LS0042', 'MP0007', '197201312003042117', 'KS0002');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `name`) VALUES
('MP0001', 'Agama'),
('MP0002', 'Bahasa Indonesia'),
('MP0003', 'Bahasa Inggris'),
('MP0004', 'Ilmu Pengetahuan Sosial'),
('MP0005', 'Matematika'),
('MP0006', 'Ilmu Pengetahuan Alam'),
('MP0007', 'Pendidikan Kewarganegaraan');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` varchar(6) NOT NULL,
  `tugas` float NOT NULL DEFAULT 0,
  `uts` float NOT NULL DEFAULT 0,
  `uas` float NOT NULL DEFAULT 0,
  `semester` int(1) NOT NULL,
  `siswaNISN` varchar(10) NOT NULL,
  `lessonID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `tugas`, `uts`, `uas`, `semester`, `siswaNISN`, `lessonID`) VALUES
('NL0001', 100, 100, 100, 1, '0041112223', 'LS0001'),
('NL0002', 100, 98, 97, 1, '0041242345', 'LS0001'),
('NL0003', 78, 63, 73, 1, '0042121354', 'LS0001'),
('NL0004', 65, 76, 87, 1, '0042233441', 'LS0001'),
('NL0005', 100, 100, 99, 1, '0042365464', 'LS0001'),
('NL0006', 39, 69, 98, 1, '0043456546', 'LS0001'),
('NL0007', 65, 34, 98, 1, '0046543126', 'LS0001'),
('NL0008', 98, 76, 87, 1, '0046843125', 'LS0001'),
('NL0009', 77, 58, 68, 1, '0049816239', 'LS0001'),
('NL0010', 92, 98, 100, 1, '0049846531', 'LS0001'),
('NL0011', 100, 100, 0, 1, '0041231242', 'LS0002'),
('NL0012', 66, 66, 66, 1, '0041298739', 'LS0002'),
('NL0013', 88, 99, 77, 1, '0043136311', 'LS0002'),
('NL0014', 68, 97, 85, 1, '0043246546', 'LS0002'),
('NL0015', 88, 77, 55, 1, '0044589769', 'LS0002'),
('NL0016', 99, 98, 97, 1, '0045675623', 'LS0002'),
('NL0017', 97, 98, 99, 1, '0046509068', 'LS0002'),
('NL0018', 77, 77, 88, 1, '0049182738', 'LS0002'),
('NL0019', 55, 55, 55, 1, '0049864756', 'LS0002'),
('NL0020', 95, 75, 85, 1, '0049871239', 'LS0002'),
('NL0021', 98, 98, 89, 1, '0031122331', 'LS0003'),
('NL0022', 65, 66, 73, 1, '0034440012', 'LS0003'),
('NL0023', 68, 97, 52, 1, '0035556641', 'LS0003'),
('NL0024', 98, 87, 77, 1, '0036548401', 'LS0003'),
('NL0025', 78, 58, 98, 1, '0037778912', 'LS0003'),
('NL0026', 88, 98, 78, 1, '0037845656', 'LS0003'),
('NL0027', 54, 78, 98, 1, '0038968697', 'LS0003'),
('NL0028', 56, 65, 87, 1, '0039873216', 'LS0003'),
('NL0029', 95, 65, 85, 1, '0039874115', 'LS0003'),
('NL0030', 100, 100, 100, 1, '0039998721', 'LS0003'),
('NL0031', 67, 78, 99, 1, '0031235331', 'LS0004'),
('NL0032', 77, 99, 99, 1, '0031235723', 'LS0004'),
('NL0033', 67, 78, 89, 1, '0031287391', 'LS0004'),
('NL0034', 99, 78, 97, 1, '0031293871', 'LS0004'),
('NL0035', 78, 99, 77, 1, '0031892073', 'LS0004'),
('NL0036', 71, 73, 98, 1, '0033344559', 'LS0004'),
('NL0037', 78, 89, 77, 1, '0038795411', 'LS0004'),
('NL0038', 78, 78, 87, 1, '0038897221', 'LS0004'),
('NL0039', 67, 78, 89, 1, '0039192838', 'LS0004'),
('NL0040', 44, 35, 0, 1, '0039911230', 'LS0004'),
('NL0041', 99, 99, 99, 1, '0021113337', 'LS0005'),
('NL0042', 91, 78, 87, 1, '0021259710', 'LS0005'),
('NL0043', 21, 45, 7, 1, '0023781901', 'LS0005'),
('NL0044', 98, 65, 78, 1, '0024652781', 'LS0005'),
('NL0045', 91, 91, 94, 1, '0025849351', 'LS0005'),
('NL0046', 98, 87, 91, 1, '0027416541', 'LS0005'),
('NL0047', 78, 87, 87, 1, '0027861470', 'LS0005'),
('NL0048', 65, 65, 32, 1, '0028499512', 'LS0005'),
('NL0049', 82, 72, 92, 1, '0028761235', 'LS0005'),
('NL0050', 45, 65, 87, 1, '0029873210', 'LS0005'),
('NL0051', 99, 99, 99, 1, '0021119992', 'LS0006'),
('NL0052', 88, 88, 88, 1, '0021583210', 'LS0006'),
('NL0053', 88, 88, 88, 1, '0022864391', 'LS0006'),
('NL0054', 45, 94, 83, 1, '0023692587', 'LS0006'),
('NL0055', 51, 16, 71, 1, '0025476328', 'LS0006'),
('NL0056', 77, 77, 77, 1, '0025487763', 'LS0006'),
('NL0057', 66, 66, 66, 1, '0025679125', 'LS0006'),
('NL0058', 66, 66, 66, 1, '0028554563', 'LS0006'),
('NL0059', 77, 77, 77, 1, '0028761236', 'LS0006'),
('NL0060', 88, 88, 88, 1, '0028852216', 'LS0006');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birth_date` date NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `kelasID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `first_name`, `last_name`, `gender`, `birth_date`, `tahun_masuk`, `username`, `password`, `kelasID`) VALUES
('0021113337', 'Rheina', 'Dea', 'Female', '2002-07-22', 2017, 'rheina.dea', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0021119992', 'Rayhan', 'Noval', 'Male', '2002-11-07', 2017, 'rayhan.noval', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0021259710', 'Moch', 'Irsal', 'Male', '2002-10-09', 2017, 'moch.irsal', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0021583210', 'Yoga', 'Zion', 'Male', '2002-03-05', 2017, 'yoga.zion', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0022864391', 'Rizkika', 'Maulina', 'Female', '2002-10-21', 2017, 'rizkika.maulina', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0023692587', 'Auria', 'Ditya', 'Female', '2002-04-16', 2017, 'auria.ditya', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0023781901', 'Rizki', 'Megantoro', 'Male', '2002-04-23', 2017, 'rizki.megantoro', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0024652781', 'Angga', 'Taufani', 'Male', '2002-01-18', 2017, 'angga.taufani', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0025476328', 'Bagas ', 'Hadiwibowo', 'Male', '2002-04-07', 2017, 'bagas .hadiwibowo', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0025487763', 'Nadira', 'Sharfina', 'Female', '2002-04-02', 2017, 'nadira.sharfina', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0025679125', 'Mevlana', 'Shafa', 'Female', '2002-07-16', 2017, 'mevlana.shafa', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0025849351', 'Kinanti', 'Rajalela', 'Female', '2002-07-17', 2017, 'kinanti.rajalela', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0027416541', 'Julian', 'Restu', 'Male', '2002-10-18', 2017, 'julian.restu', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0027861470', 'Noel', 'Alexander', 'Male', '2002-12-15', 2017, 'noel.alexander', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0028499512', 'Salsabila', 'Hanindya', 'Female', '2002-08-26', 2017, 'salsabila.hanindya', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0028554563', 'Tezzar', 'Dyandra', 'Male', '2002-07-15', 2017, 'tezzar.dyandra', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0028761235', 'Renita', 'Nanda', 'Female', '2002-12-09', 2017, 'renita.nanda', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0028761236', 'Jasmine', 'Amelia', 'Female', '2002-10-29', 2017, 'jasmine.amelia', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0028852216', 'Dianira', 'Natasya', 'Female', '2002-12-05', 2017, 'dianira.natasya', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0029873210', 'Jeremi', 'Oktavianus', 'Male', '2002-10-30', 2017, 'jeremi.oktavianus', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0031122331', 'Fadil', 'Arfan', 'Male', '2003-03-03', 2018, 'fadil.arfan', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0031235331', 'Kimberly', 'Pretisila', 'Female', '2003-05-28', 2018, 'kimberly.pretisila', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0031235723', 'Yasmin', 'Amora', 'Female', '2003-06-07', 2018, 'yasmin.amora', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0031287391', 'Farhan', 'Firdiansyah', 'Male', '2003-12-27', 2018, 'farhan.firdiansyah', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0031293871', 'Syahrul', 'Amri', 'Male', '2003-11-22', 2018, 'syahrul.amri', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0031892073', 'Daffa', 'Nabiel', 'Male', '2003-12-31', 2018, 'daffa.nabiel', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0033344559', 'Shella', 'Miliyanti Praja', 'Female', '2003-04-04', 2018, 'shella.miliyanti', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0034440012', 'Virda', 'Musliha', 'Female', '2003-03-02', 2018, 'virda.musliha', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0035556641', 'Dhiya', 'Nindya', 'Female', '2003-05-07', 2018, 'dhiya.nindya', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0036548401', 'Nadiah', 'Salsabila', 'Female', '2003-11-29', 2018, 'nadiah.salsabila', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0037778912', 'Gizhi', 'Graciaz', 'Female', '2003-01-01', 2018, 'gizha.graciaz', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0037845656', 'Haeckal', 'Abudan', 'Male', '2003-11-27', 2018, 'haeckal.abudan', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0038795411', 'Adri', 'Rahman', 'Male', '2003-11-09', 2018, 'adri.rahman', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0038897221', 'Bagus', 'Prasetya', 'Male', '2003-08-16', 2018, 'bagus.prasetya', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0038968697', 'Rifdha', 'Hanivah', 'Female', '2003-01-30', 2018, 'rifdha.hanivah', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0039192838', 'Abraham', 'Reynaldi', 'Male', '2003-08-29', 2018, 'abraham.reynaldi', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0039873216', 'Rahman', 'Eriadi', 'Male', '2003-11-30', 2018, 'rahman.eriadi', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0039874115', 'Dimas', 'Pranata', 'Male', '2003-05-31', 2018, 'dimas.pranata', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0039911230', 'Twinky', 'Ammoreta', 'Female', '2003-08-09', 2018, 'twinky.ammoreta', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0039998721', 'Salma', 'Khairani', 'Female', '2003-11-03', 2018, 'salma.khairani', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0041112223', 'Tel', 'Annas', 'Female', '2004-08-29', 2019, 'tel.annas', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0041231242', 'Widza', 'Widzi', 'Female', '2004-12-15', 2019, 'widza.widzi', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0041242345', 'Teuku', 'Sunan', 'Male', '2004-01-04', 2019, 'teuku.sunan', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0041298739', 'Fiza', 'Fizi', 'Female', '2004-10-09', 2019, 'fiza.fizi', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0042121354', 'Kumar', 'Kemer', 'Male', '2004-12-27', 2019, 'kumar.kemer', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0042233441', 'Feraldi', 'Fauzan', 'Male', '2004-01-19', 2019, 'feraldi.fauzan', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0042365464', 'Natalia', 'Gracilie', 'Female', '2004-03-02', 2019, 'natalia.natalie', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0043136311', 'Larasati', 'Kurniawan', 'Female', '2004-02-12', 2019, 'larasati.kurniawan', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0043246546', 'Capheny', 'Jordan', 'Female', '2004-04-16', 2019, 'capheny.jordan', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0043456546', 'Komar', 'Kamir', 'Male', '2004-12-31', 2019, 'komar.kamir', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0044589769', 'Upin', 'Ipin', 'Male', '2004-10-18', 2019, 'upin.ipin', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0045675623', 'Mael', 'Husein', 'Male', '2004-07-15', 2019, 'mael.husein', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0046509068', 'Pisa', 'Pisi', 'Male', '2004-07-16', 2019, 'pisa.pisi', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0046543126', 'Hanif', 'Fathan', 'Male', '2004-09-09', 2019, 'hanif.fathan', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0046843125', 'Fika', 'Fiki', 'Female', '2004-11-03', 2019, 'fika.fiki', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0049182738', 'Kemarin', 'Kemaran', 'Male', '2004-04-02', 2019, 'kemarin.kemaran', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0049816239', 'Alice', 'Gracilie', 'Female', '2004-11-30', 2019, 'alice.gracilie', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0049846531', 'Luresya', 'Luresyi', 'Female', '2004-05-07', 2019, 'luresya.luresyi', 'bcd724d15cde8c47650fda962968f102', 'KS0005'),
('0049864756', 'Ehsan', 'Ehsin', 'Male', '2004-12-05', 2019, 'ehsan.ehsin', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0049871239', 'Meza', 'Mezi', 'Female', '2004-10-30', 2019, 'meza.mezi', 'bcd724d15cde8c47650fda962968f102', 'KS0006');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matpelID` (`matpelID`),
  ADD KEY `kelasID` (`kelasID`),
  ADD KEY `guruNIP` (`guruNIP`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswaNISN` (`siswaNISN`),
  ADD KEY `mengajarID` (`lessonID`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `ruangkelasID` (`kelasID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`guruNIP`) REFERENCES `guru` (`nip`),
  ADD CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`matpelID`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `lesson_ibfk_4` FOREIGN KEY (`kelasID`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`lessonID`) REFERENCES `lesson` (`id`),
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`siswaNISN`) REFERENCES `siswa` (`nisn`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelasID`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
