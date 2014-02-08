-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2013 at 04:52 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mag`
--
CREATE DATABASE IF NOT EXISTS `mag` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mag`;

-- --------------------------------------------------------

--
-- Table structure for table `law`
--

CREATE TABLE IF NOT EXISTS `law` (
  `ID` int(2) DEFAULT NULL,
  `NAME` varchar(80) DEFAULT NULL,
  `ALTNAME` varchar(31) DEFAULT NULL,
  `DESCRIPTION` varchar(20) DEFAULT NULL,
  `ADDRESS` varchar(80) DEFAULT NULL,
  `CITY` varchar(15) DEFAULT NULL,
  `State` varchar(7) DEFAULT NULL,
  `NUMBER_OF_` int(1) DEFAULT NULL,
  `WEB` varchar(47) DEFAULT NULL,
  `longi` float(11,8) DEFAULT NULL,
  `lat` float(11,8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `law`
--

INSERT INTO `law` (`ID`, `NAME`, `ALTNAME`, `DESCRIPTION`, `ADDRESS`, `CITY`, `State`, `NUMBER_OF_`, `WEB`, `longi`, `lat`) VALUES
(1, 'Apache Junction Police Department', '', 'Police', '1001 N Idaho Rd', 'Apache Junction', 'Arizona', 0, 'www.ajcity.net/index.aspx?nid=112', -111.54521942, 33.42360687),
(2, 'Avondale Police Department', '', 'Police', '11485 W Civic Center Dr', 'Avondale', 'Arizona', 0, 'avondale.org/police', -112.30469513, 33.44298172),
(3, 'Buckeye Police Department', '', 'Police', '100 N Apache Rd', 'Buckeye', 'Arizona', 0, 'www.buckeyeaz.gov/index.aspx?nid=85', -112.57271576, 33.37230301),
(4, 'Chandler Police Department', 'Main Station', 'Police', '250 East Chicago St', 'Chandler', 'Arizona', 0, 'chandlerpd.com', -111.83799744, 33.30080032),
(5, 'Chandler Police Department', 'Desert Breeze Substation', 'Police', '251 N Desert Breeze Blvd', 'Chandler', 'Arizona', 0, 'chandlerpd.com', -111.91943359, 33.30698776),
(6, 'Chandler Police Department', 'Chandler Heights Substation', 'Police', '4040 E Chandler Heights Rd', 'Chandler', 'Arizona', 0, 'chandlerpd.com', -111.77127075, 33.23534393),
(7, 'El Mirage Police Department', '', 'Police', '14405 N Palm St', 'El Mirage', 'Arizona', 0, 'az-elmirage2.civicplus.com/index.aspx?NID=267', -112.32234955, 33.61470795),
(8, 'Fountain Hills Marshal''s Department', '', 'Police', '16705 E Ave of the Fountains', 'Fountain Hills', 'Arizona', 0, 'www.fh.az.gov/dept-law-enforcement.aspx', -111.72101593, 33.60459137),
(9, 'Gilbert Police Department', 'Main', 'Police', '75 E Civic Center Dr', 'Gilbert', 'Arizona', 0, 'www.gilbertaz.gov/police', -111.78726959, 33.33113480),
(10, 'Gilbert Police Department', 'Santan Substation', 'Police', '2332 E Queen Creek Rd', 'Gilbert', 'Arizona', 0, 'www.gilbertaz.gov/police', -111.73877716, 33.26387024),
(11, 'Glendale Police Department', 'Main Station', 'Police', '6835 N 57th Dr', 'Glendale', 'Arizona', 0, 'www.glendaleaz.com/police', -112.18210602, 33.53725433),
(12, 'Glendale Police Department', 'Foothills Substation', 'Police', '6255 W Union Hills Dr', 'Glendale', 'Arizona', 0, 'www.glendaleaz.com/police', -112.19432831, 33.65372849),
(13, 'Glendale Police Department', 'Gateway Substation', 'Police', '6261 N 83rd Ave', 'Glendale', 'Arizona', 0, 'www.glendaleaz.com/police', -112.23699951, 33.52800751),
(14, 'Goodyear Police Department', '', 'Police', '175 N 145th Ave', 'Goodyear', 'Arizona', 0, 'www.goodyearaz.gov/index.aspx?NID=59', -112.37056732, 33.44908905),
(15, 'Mesa Police Department', 'Main Station', 'Police', '120 N Robson', 'Mesa', 'Arizona', 0, 'www.mesaaz.gov/POLICE', -111.83736420, 33.41837692),
(16, 'Mesa Police Department', 'Dobson Substation', 'Police', '2505 S Dobson Rd', 'Mesa', 'Arizona', 0, 'www.mesaaz.gov/POLICE', -111.87895203, 33.37030411),
(17, 'Mesa Police Department', 'Red Mountain Substation', 'Police', '4333 E University Dr', 'Mesa', 'Arizona', 0, 'www.mesaaz.gov/POLICE', -111.73781586, 33.42189789),
(18, 'Mesa Police Department', 'Superstition Substation', 'Police', '2430 S Ellsworth Rd', 'Mesa', 'Arizona', 0, 'www.mesaaz.gov/POLICE', -111.63706970, 33.37155151),
(19, 'Paradise Valley Police Department', '', 'Police', '6433 E Lincoln Dr', 'Paradise Valley', 'Arizona', 0, 'www.ci.paradise-valley.az.us/index.aspx?nid=125', -111.94250488, 33.53074265),
(20, 'Peoria Police Department', '', 'Police', '8343 W Monroe St', 'Peoria', 'Arizona', 0, 'www.peoriaaz.gov/police', -112.23866272, 33.57696533),
(21, 'Phoenix Police Department', 'Downtown', 'Police', '620 W Washington St', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -112.08227539, 33.44858932),
(22, 'Phoenix Police Department', 'Desert Horizon Precinct', 'Police', '16030 N 56th St', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -111.96173096, 33.63246536),
(23, 'Phoenix Police Department', 'Black Mountain Precinct', 'Police', '33355 N Cave Creek Rd', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -111.96923065, 33.78775406),
(24, 'Phoenix Police Department', 'Cactus Park Precinct', 'Police', '12220 N 39th Ave', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -112.14326477, 33.59683228),
(25, 'Phoenix Police Department', 'Mountain View Precinct', 'Police', '2075 E Maryland Ave', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -112.03700256, 33.53060150),
(26, 'Phoenix Police Department', 'Central City Precinct', 'Police', '1902 S 16th St', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -112.04829407, 33.43007660),
(27, 'Phoenix Police Department', 'Estrella Mountain Precinct', 'Police', '2111 S 99th Ave', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -112.27169037, 33.42716599),
(28, 'Phoenix Police Department', 'Maryvale Precinct', 'Police', '6180 W Encanto Blvd', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -112.19300842, 33.47431564),
(29, 'Phoenix Police Department', 'South Mountain Precinct', 'Police', '400 W Southern Ave', 'Phoenix', 'Arizona', 0, 'www.phoenix.gov/police', -112.07923889, 33.39277267),
(30, 'Scottsdale Police Department', 'District 1 McKellips', 'Police', '7601 E McKellips Rd', 'Scottsdale', 'Arizona', 0, 'www.scottsdaleaz.gov/police', -111.91709137, 33.45019913),
(31, 'Scottsdale Police Department', 'District 2 Downtown', 'Police', '3700 N 75th St', 'Scottsdale', 'Arizona', 0, 'www.scottsdaleaz.gov/police', -111.92041779, 33.49042892),
(32, 'Scottsdale Police Department', 'District 3 Via Linda', 'Police', '9065 E Via Linda', 'Scottsdale', 'Arizona', 0, 'www.scottsdaleaz.gov/police', -111.88418579, 33.56941223),
(33, 'Scottsdale Police Department', 'District 4 Foothills', 'Police', '20363 N Pima Rd', 'Scottsdale', 'Arizona', 0, 'www.scottsdaleaz.gov/police', -111.88930511, 33.67191315),
(34, 'Surprise Police Department', '', 'Police', '14250 W Statler Plaza', 'Surprise', 'Arizona', 0, 'surpriseaz.com/police', -112.36496735, 33.62624359),
(35, 'Tempe Police Department', 'Main Station', 'Police', '120 E 5th St', 'Tempe', 'Arizona', 0, 'www.tempe.gov/index.aspx?page=111', -111.93740845, 33.42575073),
(36, 'Tempe Police Department', 'Mounted Unit', 'Police', '1855 E Apache Blvd', 'Tempe', 'Arizona', 0, 'www.tempe.gov/index.aspx?page=111', -111.90552521, 33.41417694),
(37, 'Tempe Police Department', 'South Substation', 'Police', '8201 S Hardy Dr', 'Tempe', 'Arizona', 0, 'www.tempe.gov/index.aspx?page=111', -111.95355988, 33.34111404),
(38, 'Tolleson Police Department', '', 'Police', '8350 W Van Buren St', 'Tolleson', 'Arizona', 0, 'tollesonaz.org/index.aspx?nid=15', -112.24037170, 33.45248795),
(39, 'Wickenburg Police Department', '', 'Police', '155 N Tegner St', 'Wickenburg', 'Arizona', 0, 'ci.wickenburg.az.us/index.aspx?NID=73', -112.73088837, 33.97006989),
(40, 'Maricopa County Sheriff', 'District 1 Main', 'Police', '1840 S Lewis', 'Mesa', 'Arizona', 0, 'www.mcso.org', -111.82953644, 33.38194656),
(41, 'Maricopa County Sheriff', 'District 2 Main', 'Police', '920 E Van Buren St', 'Avondale', 'Arizona', 0, 'www.mcso.org', -112.33872986, 33.45042038),
(42, 'Maricopa County Sheriff', 'District 2 Gila Bend Substation', 'Police', '209 E Pima St', 'Gila Bend', 'Arizona', 0, 'www.mcso.org', -112.71494293, 32.94731140),
(43, 'Maricopa County Sheriff', 'District 3 Main', 'Police', '13063 W Bell Rd', 'Surprise', 'Arizona', 0, 'www.mcso.org', -112.32701111, 33.63815308),
(44, 'Maricopa County Sheriff', 'District 4 Main', 'Police', '37622 N Cave Creek Rd', 'Cave Creek', 'Arizona', 0, 'www.mcso.org', -111.95574951, 33.82763290),
(45, 'Maricopa County Sheriff', 'District 6 Main', 'Police', '22626 S Ellsworth Rd', 'Queen Creek', 'Arizona', 0, 'www.mcso.org', -111.63489532, 33.24232483),
(46, 'Maricopa County Sheriff', 'District 7 Main', 'Police', '16705 E Ave of the Fountains', 'Fountain Hills', 'Arizona', 0, 'www.mcso.org', -111.72116089, 33.60473251),
(47, 'Fort McDowell Police Department', '', 'Police', '10755 N Fort McDowell Rd', 'Fort McDowell', 'Arizona', 0, 'www.ftmcdowell.org/fmpd/index.htm', -111.67613983, 33.65689850),
(48, 'Salt River Police Department', '', 'Police', '10005 E Osborn Rd', 'Scottsdale', 'Arizona', 0, 'www.srpmic-nsn.gov/government/srpd', -111.86353302, 33.48670197);

-- --------------------------------------------------------

--
-- Table structure for table `victimservices`
--

CREATE TABLE IF NOT EXISTS `victimservices` (
  `ID` int(2) DEFAULT NULL,
  `NAME` varchar(80) DEFAULT NULL,
  `AGENCY` varchar(55) DEFAULT NULL,
  `ADDRESS` varchar(80) DEFAULT NULL,
  `CITY` varchar(16) DEFAULT NULL,
  `State` varchar(7) DEFAULT NULL,
  `ZIP` int(5) DEFAULT NULL,
  `PHONE` varchar(16) DEFAULT NULL,
  `ALTPHONE` varchar(33) DEFAULT NULL,
  `FAX` varchar(14) DEFAULT NULL,
  `WEB` varchar(74) DEFAULT NULL,
  `EMAIL` varchar(41) DEFAULT NULL,
  `HOURS` varchar(71) DEFAULT NULL,
  `SERVICEARE` varchar(35) DEFAULT NULL,
  `AREA_OTHER` varchar(49) DEFAULT NULL,
  `DESCRIPT_F` varchar(1) DEFAULT NULL,
  `DESCRIPT_L` varchar(3) DEFAULT NULL,
  `DESCRIPT_M` varchar(1) DEFAULT NULL,
  `DESCRIPT_S` varchar(1) DEFAULT NULL,
  `DESCRIPT_P` varchar(3) DEFAULT NULL,
  `DESCRIPT_N` varchar(3) DEFAULT NULL,
  `DESCRIPT_H` varchar(1) DEFAULT NULL,
  `DESCRIPT_O` varchar(101) DEFAULT NULL,
  `LANG` varchar(25) DEFAULT NULL,
  `LANG_OTHER` varchar(89) DEFAULT NULL,
  `SVCTYPE_CR` int(1) DEFAULT NULL,
  `SVCTYPE_LE` int(1) DEFAULT NULL,
  `SVCTYPE_CI` int(1) DEFAULT NULL,
  `SVCTYPE_SA` int(1) DEFAULT NULL,
  `SVCTYPE_SO` int(1) DEFAULT NULL,
  `SVCTYPE_ME` int(1) DEFAULT NULL,
  `SVCTYPE_SH` int(1) DEFAULT NULL,
  `SVCTYPE_PO` int(1) DEFAULT NULL,
  `SVCTYPE_RE` int(1) DEFAULT NULL,
  `SVCTYPE_ON` int(1) DEFAULT NULL,
  `SVCTYPE__1` int(1) DEFAULT NULL,
  `SVCTYPE__2` int(1) DEFAULT NULL,
  `ALL_SERVIC` varchar(17) DEFAULT NULL,
  `SVCTYPE_OT` varchar(254) DEFAULT NULL,
  `FEE` varchar(5) DEFAULT NULL,
  `FEE_OTHER` varchar(254) DEFAULT NULL,
  `DESCRIPT_1` varchar(1) DEFAULT NULL,
  `longi` float(11,8) DEFAULT NULL,
  `lat` float(11,8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `victimservices`
--

INSERT INTO `victimservices` (`ID`, `NAME`, `AGENCY`, `ADDRESS`, `CITY`, `State`, `ZIP`, `PHONE`, `ALTPHONE`, `FAX`, `WEB`, `EMAIL`, `HOURS`, `SERVICEARE`, `AREA_OTHER`, `DESCRIPT_F`, `DESCRIPT_L`, `DESCRIPT_M`, `DESCRIPT_S`, `DESCRIPT_P`, `DESCRIPT_N`, `DESCRIPT_H`, `DESCRIPT_O`, `LANG`, `LANG_OTHER`, `SVCTYPE_CR`, `SVCTYPE_LE`, `SVCTYPE_CI`, `SVCTYPE_SA`, `SVCTYPE_SO`, `SVCTYPE_ME`, `SVCTYPE_SH`, `SVCTYPE_PO`, `SVCTYPE_RE`, `SVCTYPE_ON`, `SVCTYPE__1`, `SVCTYPE__2`, `ALL_SERVIC`, `SVCTYPE_OT`, `FEE`, `FEE_OTHER`, `DESCRIPT_1`, `longi`, `lat`) VALUES
(1, 'Celeste Adams', 'Save the Family', '450 W 4th Place', 'Mesa', 'Arizona', 85201, '4808980228', '', '480-898-1191', 'www.savethefamily.org', 'sfamily.org', 'M-F, 8-5pm', 'East Valley', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Transitional housing, Affordable housing, Rapid Re-housing, Supportive Services for Homeless Families', 'English/Spanish Bilingual', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', 'Transitional housing, Affordable Housing, Rapid Rehousing, Supportive Services for Veteran Families', 'Other', 'Transitional Housing - 30% of adjusted gross income; Rapid Re-housing - step down rental subsidy; Affordable Rentals - rents staring at $450/month', 'N', -111.84062958, 33.42338943),
(2, 'Tracey Wilkinson', 'Scottsdale Police Crisis Intervention', '3700 N 75 St', 'Scottsdale', 'Arizona', 85251, '4803125055', '480-312-5000', '480-312-7787', 'www.scottsdaleaz.gov/Police/about/ISB/Investigative_Services_Division/pcis', 'twilkinson@scottsdaleaz.gov', 'M-F, 8-5pm;  24 hrs. for Scottsdale Police', 'Other', 'City of Scottsdale', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'English/Spanish Bilingual', '', 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 0, '1.10E+11', '', 'No', '', 'N', -111.91967010, 33.49044037),
(3, 'Betsy Jo Fairbrother', 'Chandler Police Department', '250 E Chicago St', 'Chandler', 'Arizona', 85225, '4807824535', '4807824130', '4807824530', 'www.chandlerpd.com', 'betsyjo.fairbrother@chandleraz.gov', 'M-F, 8-6pm', 'Other', 'Chandler or any as applicable', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'Other', 'I''m bilingual in French, others are bilingual in Spanish', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, '1.11E+11', 'transportation if appropriate', 'No', '', 'N', -111.83816528, 33.30066681),
(4, 'Chris Hancock', 'Greenlee County Attorney''s Office', '223 5th St', 'Clifton', 'Arizona', 85533, '9288654108', '', '928.865.4665', 'www.co.greenlee.az.us', 'chancock@co.greenlee.az.us', 'Call for hours', 'Other', 'Greenlee County', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'N', 'Crime Victim Compensation Program', 'English Only', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000', '', 'No', '', 'N', -109.29103088, 33.04605865),
(5, 'Deborah Cantrell-Turner', 'A New Leaf', '868 E University Dr', 'Mesa', 'Arizona', 85203, '4809690039', '480-768-8106', '', 'www.turnanewleaf.org', 'dcantrell-turner@turnanewleaf.org', 'M-F, 8-5pm', 'East Valley', '', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'N', 'work as DV court advocate at both Municipal Ct & Superior Ct but employed with Nonprofit agency', 'English/Spanish Bilingual', '', 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, '111101001', 'referrals for; food, srp, housing, clothing, financial assistance, legal resources', 'No', '', 'N', -111.81185913, 33.42241669),
(6, 'Wendy Y. Shepherd', 'Voices Empowered', '18631 N 19th Ave, Ste 158, Box 305', 'Phoenix', 'Arizona', 85027, '6239863987', '', '', 'www.voicesempowered.org', 'info@voicesempowered.org', '24 hours', 'Statewide', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Investigation & Advocacy', 'Other', 'English & 68 Languages through translation service', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, '1.11E+11', 'Investigation ', 'Other', '', 'N', -112.09973907, 33.65606308),
(7, 'Melissa Thomas', 'Glendale Police Department - Victim Assistance Unit', '6835 N 57th Dr', 'Glendale', 'Arizona', 85301, '6239303030', '623-930-3720', '623-939-6701', 'www.glendaleaz.com', 'pdva@glendaleaz.com', 'M-F, 8-5pm; Crisis 24/7', 'West Valley', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'Other', 'English/Spanish; all others by language line', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1.10E+11', '', 'No', '', 'N', -112.18238068, 33.53744125),
(9, 'Legal Advoacy Hotline', 'Arizona Coaltion Against Domestic Violence', '2800 N Central Ste 1570', 'Phoenix', 'Arizona', 85004, '6022792900', '(800) 782-6400, TTY: 602-279-7270', '602-279-2980', 'www.azcadv.org', 'legaladvocacy@azcadv.org', 'M-F, 8:30am-5pm, excluding holidays', 'Statewide', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Non-Profit Statewide', 'Other', 'English/Spanish Bilingual, Hebrew', 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, '11111111001', 'Phone Based Legal Advocacy Hotline for Domestic Violence', 'No', '', 'N', -112.07393646, 33.47924042),
(10, 'Jovita Hernandez', 'Avondale Family Connections', '290 E La Canada Blvd', 'Avondale', 'Arizona', 85323, '6239328058', '(602) 540-9705', '623-333-0700', 'www.avondale.org', 'aarmenta@avondale.org', 'M-Th, 7am-5:30pm', 'Other', 'City of Avondale', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'English/Spanish Bilingual', '', 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, '1.00E+11', '', 'No', '', 'N', -112.34658813, 33.44626617),
(11, 'Ralph McLaughlin', 'Goodyear Police Department', '190 N Litchfield Rd', 'Goodyear', 'Arizona', 85338, '6236930040', '', '', 'www.goodyearaz.gov', 'rmclaughlin@goodyearaz.gov', 'M-F, 8-4; 24/7 emergency service', 'West Valley', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'English Only', '', 1, 0, 0, 1, 1, 0, 1, 1, 1, 0, 0, 0, '1.00E+11', '', 'No', '', 'N', -112.35830688, 33.44866943),
(12, 'Teri Mingus Med', 'Mesa Police Department', '130 N Robson St', 'Mesa', 'Arizona', 85201, '4806444675', '', '', 'www.cityofmesa.org/police/cafv', 'teri.mingus@mesaaz.gov', '6am-6pm for advocates, Center is open 24/7', 'East Valley', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'Sexual Assault Medical Facility', 'English/Spanish Bilingual', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, '1.11E+11', 'Teen Dating Violence Presentations @ schools, Community Awareness', 'No', '', 'N', -111.83679199, 33.41905975),
(13, 'Angela Rose', 'Scottsdale Victim Services Division', '3700 N 75 St', 'Scottsdale', 'Arizona', 85251, '4803124223', '', '480-312-9004', 'www.scottsdaleaz.gov/departments/attorney/victimservices', 'victimservices@scottsdaleaz.gov', 'M-F, 8-5pm', 'East Valley', '', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '', 'English/Spanish Bilingual', '', 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 0, '10110110000', '', 'No', '', 'N', -111.91967010, 33.49044037),
(14, 'Sarah Youngblood', 'Community Legal Services', '20 W 1st St Ste 101', 'Mesa', 'Arizona', 85201, '4808331442 x2940', '', '(480) 833-1746', 'www.clsaz.org', 'syoungblood@clsaz.org', 'M-F, 8-5pm', 'Other', 'Yuma, Yavapai, Regional & Mohave, La Paz Counties', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', '', 'Other', 'English/Spanish Bilingual, Professional Interpreters available for a variety of Languages', 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, '1000010000', 'Assistance with civil legal problems including Family Law, Landlord-Tenant, Employment, Consumer Fraud, Bankruptcy, Tax, education, health care law, public benefits', 'No', '', 'N', -111.83238220, 33.41144562),
(15, 'Debbie Davis', 'Desert Mission Inc', '9201 N 5th St', 'Phoenix', 'Arizona', 85020, '6023315817', '602-870-6060 x 6813', '', 'www.jcl.com', 'debbie.davis@jcl.com', 'M Tues Th 8-5pm;  Wed 8-6pm', 'Regional', '', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', '', 'English/Spanish Bilingual', '', 0, 0, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, '11010000', '', 'Other', 'AHCCCS Provider Sliding Fees Scale', 'N', -112.06733704, 33.56999969),
(16, 'Robin Miller', 'Gila County Attorney / Timeout Shelter', '714 S Beeline Hwy Ste 202', 'Payson', 'Arizona', 85541, '9284725363', '', '928 474-9066', 'co.gila.az.us', 'rmiller@co.gila.az.us', 'M-F, 8-5pm', 'Statewide', '', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'N', '', 'English Only', '', 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 0, '10110110000', 'Victim Comp Fund Application assistance.', 'No', '', 'N', -111.32438660, 34.23183441),
(17, 'Lacey Rose Cox, LCSW Counseling Manager', 'Gilbert Police Department ', '75 E Civic Center Dr', 'Gilbert', 'Arizona', 85296, '4806357701', '', '480-635-7795', 'www.gilbertaz.gov/police/yar.cfm', '', 'M', 'Other', 'Gilbert', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'English/Spanish Bilingual', '', 1, 0, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, '1.00E+11', '', 'No', '', 'N', -111.78724670, 33.33110809),
(18, 'Renee Hamblin', 'Surprise Fire Department', '14250 W Statler Plaza', 'Surprise', 'Arizona', 85374, '6232225000', '623-222-5040', '623-222-5002', 'www.surpriseaz.gov', 'renee.hamblin@surpriseaz.gov', 'M-T, 7am-6pm', 'West Valley', '', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', '', 'English Only', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1.00E+11', '', 'No', '', 'N', -112.36618805, 33.62949371),
(19, 'Lynette Jelinek', 'Glendale Fire Department Crisis Response Program', '5800 W Glenn Dr, Ste 350', 'Glendale', 'Arizona', 85301, '6239304451', '(623) 826-3870', '', 'www.glendaleaz.com/CrisisResponse/index.cfm', 'ljelinek@glendaleaz.com', '24/7', 'West Valley', '', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', '', 'English/Spanish Bilingual', '', 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 0, 1, '1.01E+11', 'Brief Crisis Counseling after initial event then referrals', 'No', '', 'N', -112.18373108, 33.53990555),
(20, '', 'Glendale Family Advocacy Center', '4600 W Glendale Ave', 'Glendale', 'Arizona', 85301, '6239303030', '623-930-3030, 623-930-3720', '623-939-6701', 'www.glendaleaz.com', 'pdva@glendaleaz.com', 'M-F, 8', 'West Valley', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'FAC', 'English/Spanish Bilingual', '', 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, '1.10E+11', '', 'No', '', 'Y', -112.15791321, 33.53849792),
(21, 'Frances Ortiz', 'JFCS Shelter Without Walls', '2033 N 7th St', 'Phoenix', 'Arizona', 85006, '6024524644', '602 534 3087 (Spanish)', '(602) 452-4690', 'www.jfcsaz.org', 'frances.ortiz@jfcsarizona.com', 'M-F, 8-4pm', 'West Valley', '', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', '', 'English/Spanish Bilingual', '', 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, '1011111111', 'Support groups in Spanish and English, Education Group', 'No', '', 'N', -112.06506348, 33.47061157),
(22, 'Dena Salter MBA', 'Mariposa Wings to Safety', '2601 E Roosevelt St', 'Phoenix', 'Arizona', 85008, '6023441545', '(602) 344-5976, (602) 344-5011', '(602) 344-1582', '', 'dena_salter@dmgaz.org', '24/7', 'Regional', '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '', 'English/Spanish Bilingual', '', 1, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, '1.00E+11', '', 'No', '', 'N', -112.02587128, 33.45851517),
(23, 'Rebecca Begay', 'Mesa City Prosecutor', '250 E 1st Ave, Ste 222', 'Mesa', 'Arizona', 85201, '4806442188', '', '480-644-2584', 'www.Mesaaz.gov', 'Rebecca.begay@mesaaz.gov', 'M-Th, 7am-6pm', 'East Valley', '', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '', 'English/Spanish Bilingual', '', 0, 1, 0, 0, 1, 0, 0, 1, 0, 1, 0, 1, '10010010101', 'Court Escort', 'No', '', 'N', -111.82501221, 33.41292953),
(24, '', 'Mesa Police Department- Center Against Family Violence', '130 N Robson', 'Mesa', 'Arizona', 85201, '4806442036', '', '', 'www.mesaaz.gov/police/CAFV/VictimServices.aspx', '"Danielle.Fallbeck@mesaaz.gov', 'Tues-F, 8am-6pm', 'West Valley', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'English Only', '', 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 0, 1, '1.01E+11', '', 'No', '', 'N', -111.83679199, 33.41905975),
(25, 'Kerry Ramella', 'Phoenix Fire Department', '4056 E Washington', 'Phoenix', 'Arizona', 85004, '6025342120', '', '602-534-2122', 'www.Phoenix.gov/fac', 'kerry.ramella@phoenix.gov', 'M-F, 8-5pm', 'Statewide', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'FD', 'English/Spanish Bilingual', '', 1, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0, 1, '1.00E+11', 'Forensic exams, support groups, Liaison with detectives,  on going case status, 911 phone loan program, Assistance completing  Victim', 'No', '', 'N', -111.99344635, 33.44826126),
(26, 'Victim Services', 'Arizona Attorney General', '1275 W Washington', 'Phoenix', 'Arizona', 85007, '6025424911', '', '(602) 542-8453', 'www.azag.gov/victims_rights', 'victimservices@azag.gov', 'M-F, 8-5pm', 'Statewide', '', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '', 'English Only', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000', '', 'No', '', 'N', -112.08927155, 33.44812393),
(27, 'Angelina Johnson', 'Bullhead City Prosecutor''s Office Crime Victim Services', '1255 Marina Blvd', 'Bullhead City', 'Arizona', 86442, '9287630163', '', '928-763-0156', 'www.bullheadcity.com', 'ajohnson@bullheadcity.com', 'Call for hours', 'Other', 'Mohave County/Bullhead/Tri-State', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', '', 'English Only', '', 1, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, '1.00E+11', '', 'No', '', 'N', -114.60198212, 35.10069275),
(28, 'Kaurtney Slade', 'EMPACT - SPC Trauma Healing Services', '618 S Madison Dr', 'Tempe', 'Arizona', 85282, '4807841514', '480-736-4949', '', 'www.empact-spc.com', 'kaurtney.slade@empact-spc.com', 'Crisis services are 24/7. Everything else is M-F 8-8pm', 'Regional', '', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', '', 'English/Spanish Bilingual', '', 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 0, 0, '1.10E+11', 'Men''s Support gp, Women''s Support gp, DBT Skills gp', 'No', '', 'N', -111.97402191, 33.42339706),
(29, 'Ed Mercurio-Sakwa', 'Emerge! Center Against Domestic Abuse', '2545 E Adams St', 'Tucson', 'Arizona', 85716, '5207958001', '', '520-795-1559', 'www.emergecenter.org', 'edm@emergecenter.org', 'Administration: M-F 8:30am - 5pm; Emergency Services available 24/7/365', 'Other', 'Tucson/Southern Arizona', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', '', 'English/Spanish Bilingual', '', 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, '1.00E+11', 'Lay legal advocacy, domestic abuse education, housing programs, etc.', 'No', '', 'N', -110.93468475, 32.24075317),
(31, 'Iva Rody', 'El Mirage Police Department', '12145 NW Grand Ave', 'El Mirage', 'Arizona', 85335, '6234339539', '', '', 'az-elmirage2.civicplus.com/index.aspx?NID=907', 'irody@cityofelmirage.org', 'Varies 24/7', '', 'West Valley', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'English Only', '', 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, '', '', '', '', 'N', -112.32190704, 33.61572266),
(34, 'JoAnn Del-Colle', 'Phoenix Family Advocacy Center', '2120 N. Central Ave. #250', 'Phoenix', 'Arizona', 85284, '6025342120', '', '602-534-2122', 'www.phoenix.gov/fac', '', '', '', 'city of Phoenix', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'FAC', 'EngSp', '', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '', '', 'No', '', 'Y', -112.07421112, 33.47126770),
(35, 'Debbie Driscol', 'Buckeye Police Department', '100 N. Apache Rd. Suite D', 'Buckeye', 'Arizona', 85326, '6233496400', '623-293-3176', '623-349-6506', 'www.buckeyeaz.gov', 'ddriscol@buckeyeaz.gov', '24/7', 'West Valley', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'English Only', '', 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, '', '', 'No', '', 'N', -112.57270050, 33.37228012),
(36, 'Dina Aguilera', 'Gilbert Prosecutor''s Office', '55 E Civic Center Dr Suite 205', 'Gilbert', 'Arizona', 85296, '4806357908', '', '480-635-7910', 'www.gilbertaz.gov', 'dina.aguilera@gilbertaz.gov', '', 'Other', 'Town of Gilbert', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '', 'EngSp', '', 0, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, '', '', 'No', 'Must be a victim of misdemeanor crime in the Town of Gilbert', 'N', -111.78907776, 33.32981110),
(37, 'Kristen Scharlau', 'Care 7', '655 S Ash Ave', 'Tempe', 'Arizona', 85281, '4803508004', '', '480-858-2176', 'www.tempe.gov/care7', 'kristen_scharlau@tempe.gov', '24 hours/day', 'Tempe', '', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', '', '', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, '', '', 'No', 'None', 'N', -111.94239807, 33.42367172),
(40, '', 'Phoenix Police Department', '300 W Washington St', 'Phoenix', 'Arizona', 85003, '6022618192', '', '', 'www.phoenix.gov/VICTIMS/restitution.html', 'vs.web.page@phoenix.gov', '', 'Phoenix', '', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', '', 'English/Spanish', '', 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, '', '', '', '', 'N', -112.07833862, 33.44874954),
(42, 'Aaron Ulibarri', 'Navajo County Family Advocacy Center', '550 N 9th Pl', 'Show Low', 'Arizona', 85901, '9285326047', '928-242-6565', '', 'acfan.net/centers/navajo-county-center.htm', 'aaron.ulibarri@navajocountyaz.gov', 'M-F, 8-5pm', 'Navajo County', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'FAC', 'English/Spanish', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'Forensic Exam', '', '', 'Y', -110.03266144, 34.25450516),
(43, 'Mary Lou O''Connell', 'H.A.V.E.N. Family Resource Center', '2174 McCulloch Blvd N', 'Lake Havasu City', 'Arizona', 86406, '9285053153', '', '928-854-6381', 'lhchavencenter.org', 'havencentermail@yahoo.com', '8-3pm, M-F.   24/7 on call', 'Mohave & LaPaz Counties', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'FAC', 'English/Spanish', '', 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, '', '', '', '', 'Y', -114.32399750, 34.47479630),
(45, 'Kara Ransom-Wright', 'Northern Arizona Center Against Sexual Assault', '2920 N 4th St', 'Flagstaff', 'Arizona', 86004, '9282136112', '', '', 'www.northcountryhealthcare.org/programs/nacasa', 'kransom-wright@northcountryhealthcare.org', 'M-F, 9-5pm office; 24/7 exams', 'Norrthern Arizona', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'English/Spanish', '', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '0', '', '', 'Y', -111.61271667, 35.21691895),
(46, 'Diane Umphress', 'Amberly''s Place', '1350 W Colorado St', 'Yuma', 'Arizona', 85365, '9283730849', '', '', 'www.amberlysplace.com', 'dianeumphress@amberlysplace.com', '', 'Yuma County', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'English/Spanish', '', 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, '', '', '', '', 'Y', -114.63632965, 32.72748566),
(47, 'Todd Larson', 'Scottsdale Police Department', '10225 E Via Linda', 'Scottsdale', 'Arizona', 85258, '4803125000', '', '', 'www.scottsdaleaz.gov', 'tlarson@scottsdaleaz.gov', 'M-F, 7-6pm', 'Scottsdale', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '', 'English/Spanish Bilingual', '', 1, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, '', '', '', '', '', -111.86073303, 33.57368851),
(50, 'Linda Melendez', 'Surprise Police Department Victim Assistance Unit', '14250 W Statler Plaza Suite 103', 'Surprise', 'Arizona', 85379, '6232224312', '', '', 'www.surpriseaz.gov', 'Linda.melendez@surpriseaz.gov', 'Tu ', 'West Valley', '', '', 'Y', '', '', '', '', '', '', 'English', '', 1, 0, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, '', '', '', '', '', -112.36704254, 33.63011169),
(51, 'Elizabeth Ditlevson Garman', 'Community Alliance Against Family Abuse (CAAFA)', '185 N Apache Trail', 'Apache Junction', 'Arizona', 85120, '4809820258', '', '', 'www.caafaaz.org', '', 'Outreach Office: M-F, 8-5pm Crisis Line and Safe Home: 24/7', 'Northern Pinal and Eastern Maricopa', '', '', '', '', '', '', 'Yes', '', '', '', '', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, '', '', '', '', '', -111.54736328, 33.41702652),
(52, 'Marcia Romano', 'Pinal County Sheriff''s Office', '971 N. Jason Lopez Circle Bld. C', 'Florence', 'Arizona', 85132, '5208665111', '520-866-5221', '', 'www.pinalcountyaz.gov', 'Marcia.Romano@pinalcountyaz.ogv', '24/7', '', 'Pinal County', '', 'Yes', '', '', '', '', '', '', '', '', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, '', '', '', '', '', -111.37742615, 33.04027939),
(54, 'Debbie Olson', 'Southwest Family Advocacy Center', '2333 N PebbleCreek Pkwy Suite A-200', 'Goodyear', 'Arizona', 85395, '6233337900', '', '', 'www.swfac.org', 'dolson@avondale.org', 'M-F 7am-6pm', '', '', '', 'Yes', '', '', '', '', '', '', 'English/Spanish', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '', '', '', '', '', -112.39205933, 33.47290802),
(55, 'Mrs. Mickel Valenzuela', 'Victim Advocate Program', '2330 McCulloch Blvd. N', 'Lake Havasu City', 'Arizona', 86403, '9288544388', '', '', 'www.lhcaz.gov', '', 'M-F, 8am-5pm', '', '', '', '', '', '', 'Yes', '', '', '', '', '', 0, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, '', '', '', '', '', -114.31906128, 34.47719574);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
