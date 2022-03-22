-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: test.union.arizona.edu    Database: signup
-- ------------------------------------------------------
-- Server version	5.5.5-10.2.41-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Employees`
--

DROP TABLE IF EXISTS `Employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `netid` varchar(45) DEFAULT NULL,
  `affiliation` varchar(45) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `banned` varchar(45) DEFAULT NULL,
  `performance` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employees`
--

LOCK TABLES `Employees` WRITE;
/*!40000 ALTER TABLE `Employees` DISABLE KEYS */;
INSERT INTO `Employees` VALUES (1,'Yontaek','Choi','email@arizona.edu','1111111111','yontaek','Student Unions',59,'No','Poor'),(2,'Tester','One','email@arizona.edu','1111111111','test1','Student Unions',999,NULL,NULL),(3,'Tester','Two','email@arizona.edu','1111111111','test2','Other',32,NULL,NULL),(4,'Tester','Thre','email@arizona.edu','1111111111','test3','Bookstore',17,NULL,NULL),(5,'Tester','Five','email@arizona.edu','1111111111','test4','Student Unions',29,NULL,NULL),(6,'Tester','Six','email@arizona.edu','1111111111','test6','Student Unions',66,NULL,NULL),(7,'Tester','Seven','email@arizona.edu','1111111111','test7','Student Unions',66,NULL,NULL),(8,'Tester','Eight','email@arizona.edu','1111111111','test8','Student Unions',50,NULL,NULL),(9,'Tester','Nine','email@arizona.edu','1111111111','test9','Student Unions',66,NULL,NULL),(10,'Tester','Ten','email@arizona.edu','1111111111','test10','Student Unions',46,NULL,NULL),(11,'Tester','afds','email@arizona.edu','1111111111','test11','Student Unions',17,NULL,NULL),(12,'Tester','fdsdfsa','email@arizona.edu','1111111111','test12','Bookstore',17,'No','Excellent'),(13,'Tester','fdas','email@arizona.edu','1111111111','test13','Parking and Transportation',17,NULL,NULL),(14,'Tester','dsdfdfdfs','email@arizona.edu','1111111111','test14','Bookstore',17,'No','Excellent'),(15,'Tester',';kjl','email@arizona.edu','1111111111','test15','Bookstore',17,NULL,NULL),(16,'Tester','fadsdfasds','email@arizona.edu','1111111111','test16','Parking and Transportation',32,NULL,NULL),(17,'Tester','fads','email@arizona.edu','1111111111','test17','Parking and Transportation',50,NULL,NULL),(18,'Tester','adsfadsffda','email@arizona.edu','1111111111','test18','Bookstore',42,'Yes','Poor'),(19,'Tester','fdasadfsfdas','email@arizona.edu','1111111111','test19','Parking and Transportation',29,NULL,NULL),(20,'Tester','fadsfads','email@arizona.edu','1111111111','test20','Parking and Transportation',50,NULL,NULL),(21,'Tester','dafsdafs','email@arizona.edu','1111111111','test21','Bookstore',50,NULL,NULL),(22,'Tester','22','email@arizona.edu','1111111111','test22','Student Unions',59,NULL,NULL),(23,'Tester','Twentythird','email@arizona.edu','1111111111','test23','Bookstore',17,NULL,NULL),(24,'Tester','Twentyfour','email@arizona.edu','1111111111','test24','Parking and Transportation',66,NULL,NULL),(25,'Tester','Twentyfive','email','phone','test25','Student Unions',4,NULL,NULL);
/*!40000 ALTER TABLE `Employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Locations`
--

DROP TABLE IF EXISTS `Locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Locations`
--

LOCK TABLES `Locations` WRITE;
/*!40000 ALTER TABLE `Locations` DISABLE KEYS */;
INSERT INTO `Locations` VALUES (1,'Arizona Market'),(2,'Chick-fil-A'),(3,'Core'),(4,'Einstein Bros Bagels'),(5,'IQ Fresh'),(6,'Nrich Urban Market'),(7,'On Deck Deli'),(8,'Pangea'),(9,'Sabor'),(10,'Starbucks @ Bookstore'),(11,'The Scoop'),(12,'Highland Market & Grill'),(13,'Red & Blue Market'),(14,'Slot Canyon'),(15,'Starbucks @ Library'),(16,'85 North'),(17,'Catalyst Cafe'),(18,'Core Plus'),(19,'Global Food Court'),(20,'Global Market'),(21,'Saffron Bites'),(998,'Catering Dock'),(999,'Other');
/*!40000 ALTER TABLE `Locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Requirements`
--

DROP TABLE IF EXISTS `Requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requirement` varchar(1000) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Requirements`
--

LOCK TABLES `Requirements` WRITE;
/*!40000 ALTER TABLE `Requirements` DISABLE KEYS */;
INSERT INTO `Requirements` VALUES (1,'Cash handling training','cashhandling'),(2,'PCI compliance training','pcicompliance'),(3,'Cook experience','cookexperience'),(4,'Experience as a Lead or Supervisor at other Student Union locations','leadexperience'),(9,'Prior experience preferred but not required','priorexperience'),(10,'Defensive Driving Certification','defensivedriving'),(11,'Title IX training preferred','titleix');
/*!40000 ALTER TABLE `Requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Shifts`
--

DROP TABLE IF EXISTS `Shifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Shifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(45) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `shift_date` varchar(45) DEFAULT NULL,
  `time_from` varchar(45) DEFAULT NULL,
  `time_to` varchar(45) DEFAULT NULL,
  `num_positions` tinyint(4) DEFAULT NULL,
  `supervisor_first_name` varchar(45) DEFAULT NULL,
  `supervisor_last_name` varchar(45) DEFAULT NULL,
  `shiftsupervisor_id` int(11) DEFAULT NULL,
  `urgent` tinyint(4) DEFAULT 0,
  `note` text DEFAULT NULL,
  `timestampt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shifts`
--

LOCK TABLES `Shifts` WRITE;
/*!40000 ALTER TABLE `Shifts` DISABLE KEYS */;
INSERT INTO `Shifts` VALUES (1,'Dining',1,'03/06/2022','04:43 AM','04:42 AM',10,'Michelle','Ward',NULL,1,'Speical note goes here.','2022-03-05 23:42:13'),(2,'Dining',18,'03/07/2022','06:32 AM','06:32 PM',1,'Lupita','Hollis',NULL,0,'Speical note goes here.','2022-03-06 01:32:43'),(3,'Dining',7,'03/08/2022','06:34 AM','06:34 PM',1,'Michelle','Ward',NULL,0,'Speical note goes here.','2022-03-06 01:33:43'),(4,'Dining',20,'03/09/2022','08:18 AM','08:18 PM',1,'Lupita','Hollis',NULL,0,'Speical note goes here.','2022-03-06 15:18:03'),(5,'Catering',998,'03/10/2022','08:22 AM','08:22 PM',1,'Lupita','Hollis',NULL,0,'Speical note goes here.','2022-03-06 15:21:55'),(6,'Dining',9,'03/11/2022','07:16 AM','07:16 PM',1,'Lupita','Hollis',NULL,0,'Speical note goes here.','2022-03-07 02:16:06'),(7,'Dining',7,'03/12/2022','02:49 AM','02:49 PM',10,'Angelica','Osuna',NULL,1,'Speical note goes here.','2022-03-07 09:49:20'),(8,'Dining',6,'03/15/2022','08:36 AM','08:36 PM',1,'Lupita','Hollis',NULL,0,'Speical note goes here.','2022-03-07 15:35:36'),(9,'Catering',998,'03/13/2022','07:08 AM','07:08 PM',5,'No','Body',NULL,0,'Speical note goes here.','2022-03-08 02:07:56'),(10,'Dining',21,'03/14/2022','07:11 AM','07:11 AM',1,NULL,NULL,12,0,'Speical note goes here.','2022-03-08 02:12:47'),(11,'Dining',5,'03/16/2022','04:21 AM','04:21 PM',5,NULL,NULL,2,0,'','2022-03-08 11:21:29'),(12,'Dining',12,'03/17/2022','04:51 AM','04:52 PM',5,NULL,NULL,0,0,'Special Note','2022-03-08 11:51:48'),(13,'Dining',6,'03/18/2022','05:04 AM','05:04 PM',1,NULL,NULL,4,0,'','2022-03-08 12:04:14');
/*!40000 ALTER TABLE `Shifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ShiftsTasks`
--

DROP TABLE IF EXISTS `ShiftsTasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ShiftsTasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_id` int(11) DEFAULT NULL,
  `task_id` tinyint(4) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `attendance` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ShiftsTasks`
--

LOCK TABLES `ShiftsTasks` WRITE;
/*!40000 ALTER TABLE `ShiftsTasks` DISABLE KEYS */;
INSERT INTO `ShiftsTasks` VALUES (1,1,1,NULL,NULL),(2,1,10,NULL,NULL),(3,2,4,NULL,NULL),(4,2,5,NULL,NULL),(5,2,9,NULL,NULL),(6,3,1,NULL,NULL),(7,3,9,NULL,NULL),(8,4,2,NULL,NULL),(9,4,3,NULL,NULL),(10,4,4,NULL,NULL),(11,5,1,NULL,NULL),(12,5,10,NULL,NULL),(13,5,2,NULL,NULL),(14,5,3,NULL,NULL),(15,6,1,NULL,NULL),(16,6,10,NULL,NULL),(17,6,2,NULL,NULL),(18,6,3,NULL,NULL),(19,6,4,NULL,NULL),(20,6,5,NULL,NULL),(21,6,8,NULL,NULL),(22,6,9,NULL,NULL),(23,7,1,NULL,NULL),(24,7,10,NULL,NULL),(25,7,2,NULL,NULL),(26,8,13,NULL,NULL),(27,8,1,NULL,NULL),(28,8,11,NULL,NULL),(29,8,10,NULL,NULL),(30,8,2,NULL,NULL),(31,8,3,NULL,NULL),(32,8,12,NULL,NULL),(33,8,4,NULL,NULL),(34,8,5,NULL,NULL),(35,8,8,NULL,NULL),(36,8,9,NULL,NULL),(37,9,13,NULL,NULL),(38,9,12,NULL,NULL),(39,9,8,NULL,NULL),(40,10,13,NULL,NULL),(41,10,1,NULL,NULL),(42,10,2,NULL,NULL),(43,11,13,NULL,NULL),(44,11,1,NULL,NULL),(45,11,11,NULL,NULL),(46,11,10,NULL,NULL),(47,11,2,NULL,NULL),(48,11,3,NULL,NULL),(49,11,12,NULL,NULL),(50,11,4,NULL,NULL),(51,11,5,NULL,NULL),(52,11,8,NULL,NULL),(53,11,9,NULL,NULL),(54,12,13,NULL,NULL),(55,12,1,NULL,NULL),(56,12,11,NULL,NULL),(57,12,10,NULL,NULL),(58,13,13,NULL,NULL);
/*!40000 ALTER TABLE `ShiftsTasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Shiftsupervisors`
--

DROP TABLE IF EXISTS `Shiftsupervisors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Shiftsupervisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shiftsupervisors`
--

LOCK TABLES `Shiftsupervisors` WRITE;
/*!40000 ALTER TABLE `Shiftsupervisors` DISABLE KEYS */;
INSERT INTO `Shiftsupervisors` VALUES (1,'Emily ','Romero','web@email.arizona.edu','Dining'),(2,'Lupita ','Hollis','web@email.arizona.edu','Dining'),(3,'Angelica ','Osuna','web@email.arizona.edu','Dining'),(4,'Michelle ','Ward','web@email.arizona.edu','Dining'),(5,'Judy ','Stout','web@email.arizona.edu','Catering'),(6,'Beaney ','Cota','web@email.arizona.edu','Catering'),(7,'Stephanie ','Bixby','web@email.arizona.edu','Catering'),(8,'Michael ','Omo','web@email.arizona.edu','Kitchen'),(9,'Taylor ','Brenden','web@email.arizona.edu','Kitchen'),(10,'Lawrence ','Sanchez','web@email.arizona.edu','Kitchen'),(11,'Manja ','Blackwood','web@email.arizona.edu','Kitchen'),(12,'Daniel ','Luna','web@email.arizona.edu','Kitchen'),(13,'Delia ','Policroniades','web@email.arizona.edu','Stewarding'),(14,'Kim ','Celaya','web@email.arizona.edu','Warehouse');
/*!40000 ALTER TABLE `Shiftsupervisors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SignupRequirements`
--

DROP TABLE IF EXISTS `SignupRequirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SignupRequirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `task_id` tinyint(4) DEFAULT NULL,
  `requirement_id` tinyint(4) DEFAULT NULL,
  `filled` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SignupRequirements`
--

LOCK TABLES `SignupRequirements` WRITE;
/*!40000 ALTER TABLE `SignupRequirements` DISABLE KEYS */;
INSERT INTO `SignupRequirements` VALUES (1,2,5,2,1,'Yes'),(2,2,5,2,2,'No'),(3,2,6,2,1,'No'),(4,2,6,2,2,'Yes'),(5,2,6,3,3,'Yes'),(6,2,6,8,4,'Maybe'),(7,2,4,2,1,'No'),(8,2,4,2,2,'Maybe'),(9,2,4,3,3,''),(10,2,11,13,11,''),(11,2,11,11,9,''),(12,2,11,2,1,'No'),(13,2,11,2,2,''),(14,2,12,13,11,'Yes'),(15,2,12,11,9,'Maybe'),(16,2,13,13,11,'Yes');
/*!40000 ALTER TABLE `SignupRequirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SignupTasks`
--

DROP TABLE IF EXISTS `SignupTasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SignupTasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_id` int(11) DEFAULT NULL,
  `task_id` tinyint(4) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `attendance` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SignupTasks`
--

LOCK TABLES `SignupTasks` WRITE;
/*!40000 ALTER TABLE `SignupTasks` DISABLE KEYS */;
INSERT INTO `SignupTasks` VALUES (1,1,1,1,'Approved','No Show'),(2,1,10,1,'Approved','No Show'),(3,2,4,1,'Filled',NULL),(4,2,5,1,'Approved','Attended'),(5,2,9,1,'Filled',NULL),(6,1,1,2,'Approved','Attended'),(7,1,10,2,'Filled',NULL),(8,2,4,2,'Approved','Attended'),(9,2,5,2,'Filled',NULL),(10,2,9,2,'Filled',NULL),(11,5,10,2,'Filled',NULL),(12,5,2,2,'Approved',NULL),(13,6,1,2,'Filled',NULL),(14,6,10,2,'Filled',NULL),(15,6,2,2,'Filled',NULL),(16,6,3,2,'Filled',NULL),(17,6,4,2,'Approved',NULL),(18,6,5,2,'Filled',NULL),(19,6,8,2,'Filled',NULL),(20,6,9,2,'Filled',NULL),(21,4,2,2,'Approved','Attended'),(22,4,3,2,'Approved','No Show'),(23,4,4,2,'Approved',NULL),(24,7,10,2,'Filled',NULL),(25,7,2,2,'Approved','Attended'),(26,11,13,2,'Filled',NULL),(27,11,1,2,'Filled',NULL),(28,11,11,2,'Filled',NULL),(29,11,10,2,'Approved',NULL),(30,11,2,2,'Filled',NULL),(31,11,3,2,'Filled',NULL),(32,11,12,2,'Filled',NULL),(33,11,4,2,'Filled',NULL),(34,11,5,2,'Filled',NULL),(35,11,8,2,'Filled',NULL),(36,11,9,2,'Filled',NULL),(37,3,1,2,'Approved',NULL),(38,12,13,2,'Filled',NULL),(39,12,1,2,'Pending',NULL),(40,12,11,2,'Pending',NULL),(41,12,10,2,'Pending',NULL),(42,13,13,2,'Filled',NULL),(43,1,1,25,'Pending',NULL),(44,1,10,25,'Pending',NULL);
/*!40000 ALTER TABLE `SignupTasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Signups`
--

DROP TABLE IF EXISTS `Signups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Signups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Signups`
--

LOCK TABLES `Signups` WRITE;
/*!40000 ALTER TABLE `Signups` DISABLE KEYS */;
INSERT INTO `Signups` VALUES (1,1,1,'Applied','2022-03-07 21:03:23'),(2,2,1,'Applied','2022-03-07 21:59:35'),(3,1,2,'Applied','2022-03-07 22:29:17'),(4,2,2,'Applied','2022-03-08 01:05:21'),(5,5,2,'Applied','2022-03-08 01:09:48'),(6,6,2,'Emailed','2022-03-08 01:18:08'),(7,4,2,'Emailed','2022-03-08 08:21:13'),(8,7,2,'Emailed','2022-03-08 10:44:46'),(9,11,2,'Emailed','2022-03-08 11:22:51'),(10,3,2,'Emailed','2022-03-08 11:41:49'),(11,12,2,'Applied','2022-03-08 11:57:15'),(12,13,2,'Applied','2022-03-08 12:04:28'),(13,1,25,'Applied','2022-03-08 12:12:16');
/*!40000 ALTER TABLE `Signups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Supervisors`
--

DROP TABLE IF EXISTS `Supervisors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Supervisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Supervisors`
--

LOCK TABLES `Supervisors` WRITE;
/*!40000 ALTER TABLE `Supervisors` DISABLE KEYS */;
INSERT INTO `Supervisors` VALUES (1,'Chelsea','Ewer','chelseao@email.arizona.edu'),(2,'Judy','Harrison','harrisoj@email.arizona.edu'),(3,'Marites Calalang','John','calalang@email.arizona.edu'),(4,'Eric','Kay','ewk@email.arizona.edu'),(5,'Jonathan Todd','Millay','jtoddmillay@email.arizona.edu'),(6,'Rachelle','Stone','rlstone@email.arizona.ed'),(7,'Christiana','Ageh','ogunmola@email.arizona.edu'),(8,'Jose (Joe)','Hernandez','hernand6@email.arizona.edu'),(9,'Stephanie','Bixby','bixby@email.arizona.edu'),(10,'Beaney Mendez','Cota','mendezb@email.arizona.edu'),(11,'Patrick','Irish','patrickirish@email.arizona.edu'),(12,'Judith','Stout','stoutj@email.arizona.edu'),(13,'Joseph','Sullivan','jjsully@email.arizona.edu'),(14,'Diane','Collins','dianelc@email.arizona.edu'),(15,'Jean','Poston','jkoski@email.arizona.edu'),(17,'Emily','Romero','emilyr1@email.arizona.edu'),(18,'Gilbert','Guerra','guerrajr@email.arizona.edu'),(19,'Vanessa','Castillo','vcastill@email.arizona.edu'),(21,'Raymie','Grimm','raymiegrimm@email.arizona.edu'),(22,'Cheryl','Plummer','cplummer@email.arizona.edu'),(23,'Nathan','Martinez','nmartinez50@email.arizona.edu'),(24,'Rolando','Mendez','rtmendez@email.arizona.edu'),(25,'Steve','Mendoza','stevemendoza@email.arizona.edu'),(26,'Tamara','Wright','twright1@email.arizona.edu'),(27,'Lauren','Graser','larenmariekrause@email.arizona.edu'),(28,'Christine','Carlson','christinecarlson@email.arizona.edu'),(29,'Angelica','Guerrero-Osuna','angelicg@email.arizona.edu'),(30,'Kevin','Buchmiller','kevinbuchmiller@email.arizona.edu'),(32,'Felipe De Jesus','Acuna','acuna@email.arizona.edu'),(36,'Marissa','Rada','marissar1@email.arizona.edu'),(40,'Michelle','Ward','michellew1@email.arizona.edu'),(41,'Arnold','Figueroa','amf1@email.arizona.edu'),(42,'Don','Bennett','bennettd@email.arizona.edu'),(44,'Jessica','Gerlach','gerlachj@email.arizona.edu'),(45,'Amanda','Fragoso','amandafragoso@email.arizona.edu'),(46,'Gabriana','Breedlove','gabriana13@email.arizona.edu'),(47,'Helyann','Carr','helyann@email.arizona.edu'),(48,'Dinalle','Jacquez','djacquez1@email.arizona.edu'),(49,'Lupita','Hollis','lupital@email.arizona.edu'),(50,'Doreena','Trujillo','dtrujillo@email.arizona.edu'),(51,'Leanne','Weigel','weigel@email.arizona.edu'),(52,'Manja','Blackwood','manjab@email.arizona.edu'),(53,'Kenneth','Davis','chefken@email.arizona.edu'),(54,'Michael','Omo','michaelomo@email.arizona.edu'),(55,'Lawrence','Sanchez','lsanchez@email.arizona.edu'),(56,'Tiffany','Kreminsky','tiffanyk2@email.arizona.edu'),(57,'Daniel','Luna','daniel84luna@email.arizona.edu'),(58,'Kimberly','Celaya','kcelaya@email.arizona.edu'),(59,'Ricardo','Carlos','ricarlos@email.arizona.edu'),(60,'Maria','Policroniades','mariap1@email.arizona.edu'),(61,'Carime','Castillo','cainclan@email.arizona.edu'),(62,'Sydnie','Brown','ssb1@email.arizona.edu'),(64,'Radley Jay','Chaves','rchaves@email.arizona.edu'),(66,'Elizabeth','Hughes','hhughes@arizona.edu'),(67,'Jason','Wright','wjasona@email.arizona.edu'),(68,'aaa','bbb','email@arizona.edu'),(999,'Other',NULL,NULL);
/*!40000 ALTER TABLE `Supervisors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tasks`
--

DROP TABLE IF EXISTS `Tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(45) DEFAULT NULL,
  `category` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tasks`
--

LOCK TABLES `Tasks` WRITE;
/*!40000 ALTER TABLE `Tasks` DISABLE KEYS */;
INSERT INTO `Tasks` VALUES (1,'Baker',1),(2,'Cashier',3),(3,'Cook',1),(4,'Expeditor',1),(5,'Express Catering Prep & Assembly',2),(8,'Lead/Supervisor',1),(9,'Runner',1),(10,'Barista',1),(11,'Banquet Server/Tray Carrier',2),(12,'Driver',2),(13,'Alcohol Server',2);
/*!40000 ALTER TABLE `Tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TasksRequirements`
--

DROP TABLE IF EXISTS `TasksRequirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TasksRequirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` tinyint(4) DEFAULT NULL,
  `requirement_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TasksRequirements`
--

LOCK TABLES `TasksRequirements` WRITE;
/*!40000 ALTER TABLE `TasksRequirements` DISABLE KEYS */;
INSERT INTO `TasksRequirements` VALUES (1,2,1),(2,2,2),(3,3,3),(4,8,4),(5,11,9),(6,12,10),(7,13,11);
/*!40000 ALTER TABLE `TasksRequirements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-08  5:44:26
