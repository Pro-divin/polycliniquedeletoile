-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2025 at 02:37 PM
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
-- Database: `clinic_dbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentId` int(11) NOT NULL,
  `departmentname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentId`, `departmentname`) VALUES
(1, 'General Medecine'),
(2, 'Internal Medecine'),
(3, 'Pediatrics'),
(4, 'Gynecology'),
(5, 'Dental'),
(6, 'Laboratory'),
(7, 'X-ray'),
(8, 'Endoscopy'),
(9, 'OPG 3D');

-- --------------------------------------------------------

--
-- Table structure for table `department_details`
--

CREATE TABLE `department_details` (
  `departdetailsId` int(11) NOT NULL,
  `departImage` varchar(255) NOT NULL,
  `departHeading` varchar(255) NOT NULL,
  `departParagraph` text NOT NULL,
  `departmentId` int(11) NOT NULL,
  `OtherParagraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_details`
--

INSERT INTO `department_details` (`departdetailsId`, `departImage`, `departHeading`, `departParagraph`, `departmentId`, `OtherParagraph`) VALUES
(1, 'Medicine (2).jpg', 'GENERAL PRACTITIONER', 'General practitioners have an important role in looking after patients in their homes and within the communities where they live. They are part of a much wider team whose role includes promoting, preventing and initiating treatment. GPs look after patients with chronic illness, with the aim to keep people in their own homes and ensuring they are as well as they possibly can be.', 1, ''),
(2, 'laboratorys.jpg', 'LABORATORY ', 'The Directorate of Education, Training and  Research at Polyclinique de l\'Etoile,aims at transforming and improving the delivery of health care by providers and practitioners within the communities we serve through state-of-the-art research and thinking.', 6, 'Services                  Hematology           This service at Polyclinic de etoile handles an inclusive diagnosis of various blood pathologies and dysfunction using different parameters including;      •Full blood count •Electrocyte sedimentation rate •Bleeding and Clotting time   •Blood grouping and Rhesus     Biochemistry          The biochemistry       service provides an extensive range of testing services using an array of both fully and semi-automated equipment diagnosing the vital functionality of the body organs. These test include;    •Glucose (Fasting, Tolerance and Random)         •HBA1C            .Urea           •Creatine       •Uric Acid       •Albumin                   •GAMMA GT                          •ASAT/GOT                         •ALAT/GPT                   •Phosphatase                   •Bilirubin (Total and Direct)                   •Lipid profiling  •Amylase                      •Lipase                  •Calcium                       •Sodium                           •Potassium                    •Magnesium                     •Chloride              Immuno-Serology          The service comprises of state-of-the-art diagnostic analysis of array of tests using plasma or serum samples. This provides an imperative overview and clear picture to the medical personnel. These include;                  •CRP                               •ASLO                              •WIDAL                            •RPR                                 •TPHA                            •Rheumatoid Factor •TOXO (IgM and IgG) •Rubella (IgM and IgG)                                   •CMV IgM                         •Hepatitis (B and C) including tests for both Ag and Ab               •SRV                           •Pylori (AC and Ag) •Chlamydia                   •Cryptocoque (Ag) •Pregnancy test  •CD4 and Hepatitis viral load Hormone Analysis This service provides a dynamic approach specific diagnosis based on the gender of the patient using blood level measurement of these hormones. The analysis presents an outline of the level of functionality or dysfunction of the body systems for example respiratory, reproductive and endocrine. The hormones investigated include;                           •Estradiol                    •Oestriol                •BHCG                    •T3                                  •T4                                   •TSH              •FSH                            •LH                       •Prolactin               •Progesterone                  •Testosterone      Parasitology          This service mostly aids in diagnosis through identifying causative parasites of an array of diseases. The tests carried out in blood and stool samples using ultra-modern equipment and testing technology. Some of tests include; •Borrella                      •Filaria                        •Trypanosoma                     •Direct stool examination                       •Parasite concentration'),
(5, 'dentist.jpg', 'DENTAL', 'The Dental and Maxillofacial unit at Polyclinique de l\'Etoile, provides a comprehensive range of services including study, prevention, diagnosis, treatment, and rehabilitation of congenital or acquired diseases of the entire facial structure: skull, mouth, teeth, jaw, face, etc and covering a wide variety of procedures.  The Dental Unit at Polyclinique de l\'Etoile,provides services including mouth examinations and x-rays taking, preventive dentistry for children and adults, restorative dentistry using modern filling materials as well as endodontic of both anterior and posterior teeth. Other services in the dental unit are aesthetic dentistry with teeth whitening, porcelain, and composite veneers, minor oral surgery such wisdom tooth removal, tooth extractions, soft tissue injury repair, prosthodontics dealing removable partial and complete dentures, dental crowns and bridges, dental implants placement and restoration, periodontal therapy dealing with periodontium by keeping healthy gingiva & bone and treating affected ones. And last but not least, preventive, interceptive, and fixed orthodontics, treatments of children with special needs under sedation, and treatments of geriatric patients', 5, ''),
(6, 'pedi.jpg', 'PEDIATRICS', 'The pediatrics department at Polyclinique de l\'Etoile specializes in the following areas: general pediatrics, pediatrics Intensive Care Unit (ICU), neonatal Intensive Care Unit (NICU), Pediatrics and Child Health at Polyclinique de l\'Etoile is dedicated to the improvement of health of all children referred from all over the country. We offer health care services, medical education and research programs that address critical issues in children’s health. Vision: Commitment to improve the health of children through excellent service delivery, education, and relevant research. ', 3, ''),
(7, 'x-rays.jpg', 'RADIOGRAPHY', 'The Radiology, Diagnostic and Imaging directorate at Polyclinique de l\'Etoile specializes \r\nin the following areas: MRI (Magnetic resonance imaging) scans, CT (computerized tomography) \r\nscans (digital and conventional), Modern Cath Lab (Angio-suite), which facilitates both\r\n Vascular & non vascular interventions, fluoroscopy (dynamic examination), ultrasound scans, \r\nmammography (breast X-ray examinations, breast cancer checkup) and in interventional procedures \r\n(Biopsy,drainage).\r\nPolyclinique de l\'Etoile  has a high-performance,fast,silent and Digital MRI scanner \r\n(1.5 Tesla).We recommend patients to come for Imaging and other interventional procedures.', 7, ''),
(8, 'echos.jpg', 'GYNECOLOGY', 'We are concerned with women’s health, before, during and after the reproductive years. We focus on childbirth, providing pre-natal care and pregnancy support along with post-partum care. At Polyclinique de l\'Etoile, we also focus on the female reproductive system including the diagnosis and treatment of disorders and diseases.Our Obstetrics and Gynecology unit has recently acquired a high-resolution ultrasound machine that will markedly improve the diagnostic accuracy for fetal anomalies in the first and second trimester of pregnancy.', 4, ''),
(9, 'internal.jpg', 'INTERNAL MEDICINE', 'The internal medicine department at Polyclinique de l\'Etoile specializes in the following areas: nephrology (treatment of kidney diseases, with an always-available dialysis unit), cardiology (treatment of heart diseases, trans-oesophageal echocardiography), dermatology (treatment of skin diseases), oncology (cancer), gastroenterology (treatment of pathologies for the stomach, liver and intestines, endoscopies, colonoscopies, and biopsies), neuro-psychiatry, psychotherapy, pulmonology, and hematology (consultations and lab diagnosis and treatment of variable complex hematology conditions). The internal medicine department also has the capacity to follow-up on patients who have had kidney (renal) transplants and is the only medical service in the country that performs artificial cardiac pacemaker implantations and follow-up.', 2, ''),
(10, 'endoscopy.png', 'Endoscopy', 'The Endoscopy Clinic performs a wide range of endoscopic procedures that allow both diagnosis and treatment of gastrointestinal disorders, such as peptic ulcers, polyps, cancers, and blockages of the bile ducts due to stones, inflammation and tumors. The Endoscopy Clinic has a special interest in bleeding from the intestines, the treatment of precancerous abnormalities in conditions referred to as Barrett\'s esophagus, and familial adenomatous polyposis syndrome. The group also specializes in the evaluation and development of new forms of endoscopes and endoscopic techniques.', 8, ''),
(11, 'OPG.jpg', '', 'The Dental Clinics & Diagnostics combines professional and experienced Dentists with the latest technology in a state of the art medical facility. Our dentists are specialized in creating beautiful, healthy smiles and provide individualized, gentle smile rejuvenations in a relaxed and friendly environment.                          \r\nX-rays use radiation to take pictures of bones and other parts inside the body. An OPG is a panoramic X-ray of the upper and lower jaws, including the teeth. The OPG unit is specifically designed to rotate around the patient’s head during the scan. An OPG will take approximately 20 seconds.', 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorId` int(11) NOT NULL,
  `doctorNames` varchar(255) NOT NULL,
  `doctorImage` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorId`, `doctorNames`, `doctorImage`, `position`) VALUES
(1, 'DR. John Butonzi', 'john.jpg', 'Internist & Oncologist'),
(2, 'DR. Uwiragiye Emmanuel', 'emmanuel.jpg', 'Pediatrics'),
(3, 'DR. Kwizera Emery', 'emery.jpg', 'General Practitioner'),
(4, 'DR. Karegeya Adolphe', 'adolphe.jpg', 'Gynecology & Obstetrics ');

-- --------------------------------------------------------

--
-- Table structure for table `doctorsdetails`
--

CREATE TABLE `doctorsdetails` (
  `detailsId` int(11) NOT NULL,
  `description` text NOT NULL,
  `doctorId` int(11) NOT NULL,
  `doctorNames` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `doctorImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctorsdetails`
--

INSERT INTO `doctorsdetails` (`detailsId`, `description`, `doctorId`, `doctorNames`, `position`, `doctorImage`) VALUES
(1, '\r\n\r\n\r\n\r\n', 1, '', 'Oncologist', 'john.jpg'),
(2, ' ', 2, '', 'Pediatrics', 'emmanuel.jpg'),
(3, '', 3, '', 'General Practitioner', 'emery.jpg'),
(4, '', 4, '', 'Gynecology & Obstetrics ', 'adolphe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `newsImage` varchar(255) NOT NULL,
  `newsDate` varchar(255) NOT NULL,
  `heading` text NOT NULL,
  `subtites` text NOT NULL,
  `paragraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `scheduleId` int(11) NOT NULL,
  `DepartmentName` varchar(255) NOT NULL,
  `DoctorName` varchar(255) NOT NULL,
  `Monday` varchar(255) NOT NULL,
  `Tuesday` varchar(255) NOT NULL,
  `Wednesday` varchar(255) NOT NULL,
  `Thursday` varchar(255) NOT NULL,
  `Friday` varchar(255) NOT NULL,
  `Saturday` varchar(255) NOT NULL,
  `Sunday` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`scheduleId`, `DepartmentName`, `DoctorName`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`) VALUES
(1, 'Internal Medicine & Hepato-gastro enterology', 'DR.Shikama Felicien', '__________', '__________', '__________', '__________', '09:00 AM - 19:00 PM', '09:00 AM - 19:00 PM', '__________'),
(2, 'Internal Medecine', 'Dr HAVUGIMANA Phocas', '09:00 AM - 19:00 PM', '09:00 AM - 19:00 PM', '09:00 AM - 19:00 PM', '09:00 AM - 19:00 PM', '__________', '__________', '__________'),
(3, 'Internal Medicine', 'DR.Bugingo Bel Ami ', '__________', '__________', '__________', '__________', '__________', '__________', '09:00 AM - 19:00 PM'),
(4, 'Pediatrics', 'Dr.Bahizi Sadallah', '__________', '__________', '__________', '__________', '08:00 AM - 21:00 PM', '08:00 AM - 21:30 PM', '08:00 AM - 21:00 PM'),
(5, 'Pediatrics', 'DR. Nzayituriki Valens', '05:00 PM - 21:00 PM', '08:00 AM - 21:00 PM', '05:00 PM - 21:00 PM', '05:00 PM - 21:00 PM', '05:00 PM - 21:00 PM', '08:00 AM - 21:00 PM', '08:00 AM - 21:00 PM'),
(6, 'Pediatrics', 'DR. Muhorakeye Aline', '08:00 AM - 05:30 PM', '__________', '__________', '08:00 AM - 05:30 PM', '__________', '__________', '__________'),
(7, 'Gynecology And Obstetrics', 'Dr.Belay Alemu Behilu', '__________', '__________', '10:00 AM - 20:30 PM', '__________', '__________', '10:00 AM - 20:30 PM', '10:00 AM - 20:30 PM'),
(8, 'Gynecology And Obstetrics', 'DR. Karegeya B. Adolphe', '10:00 AM - 20:30 PM', '10:00 AM - 20:30 PM', '__________', '10:00 AM - 20:30 PM', '10:00 AM - 20:30 PM', '__________', '__________'),
(9, 'Dentistry', 'DR. Mbusa Taiminya Philbert', '10:00 AM - 20:30 PM', '10:00 AM - 20:30 PM', '10:00 AM - 20:30 PM', '__________', '10:00 AM - 20:30 PM', '10:00 AM - 20:30 PM', '__________'),
(10, 'Dentistry', 'Dr.Muzimba Joseph', '18:00 PM - 21:00 PM', '18:00 PM - 21:00 PM', '18:00 PM - 21:00 PM', '18:00 PM - 21:00 PM', '10:00 AM - 20:30 PM', '', ''),
(11, 'Dentistry', 'Dr.Azidama Ngodzama Justin', '__________', '__________', '__________', '08:00 AM - 20:30 PM', '__________', '__________', '__________'),
(12, 'General Medicine', 'DR. Kwizera Emery', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '__________'),
(13, 'General Medicine', 'DR. Serukiza Fred', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '08:00 AM - 17:30 PM', '__________'),
(14, 'General Medicine', 'DR. Kwizera Richard', '17:30 PM - 08:00 AM', '17:30 PM - 08:00 AM', '17:30 PM - 08:00 AM', '17:30 PM - 08:00 AM', '17:30 PM - 08:00 AM', '__________', '17:30 PM - 08:00 AM'),
(15, 'General Medicine', 'DR.Fikiri Kahungu Daniel', '__________', '__________', '__________', '__________', '__________', '17:30 PM - 08:00 AM', '__________'),
(16, 'General Medicine', 'DR.Ngabirano Justin', '__________', '__________', '__________', '__________', '__________', '__________', '08:00 AM - 17:30 PM');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `slideId` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `paragraph` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`slideId`, `picture`, `title`, `paragraph`) VALUES
(1, 'customercare.jpg', '', ''),
(2, 'hospitalization.jpg', '', ''),
(3, 'maingate.jpg', '', ''),
(4, 'reception.jpg', '', ''),
(5, 'reception1.jpg', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentId`);

--
-- Indexes for table `department_details`
--
ALTER TABLE `department_details`
  ADD PRIMARY KEY (`departdetailsId`),
  ADD KEY `departmentId` (`departmentId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorId`);

--
-- Indexes for table `doctorsdetails`
--
ALTER TABLE `doctorsdetails`
  ADD PRIMARY KEY (`detailsId`),
  ADD KEY `doctorsdetails_ibfk_1` (`doctorId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`scheduleId`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`slideId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `department_details`
--
ALTER TABLE `department_details`
  MODIFY `departdetailsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctorsdetails`
--
ALTER TABLE `doctorsdetails`
  MODIFY `detailsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `scheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `slideId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
