-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: db_nata_app
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_id` int NOT NULL,
  `certificate_number` varchar(100) NOT NULL,
  `verification_code` varchar(100) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `issued_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `certificate_number` (`certificate_number`),
  UNIQUE KEY `verification_code` (`verification_code`),
  KEY `fk_certificate_registration` (`registration_id`),
  CONSTRAINT `fk_certificate_registration` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `training_field_id` int NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `fk_employee_training_field` (`training_field_id`),
  CONSTRAINT `fk_employee_training_field` FOREIGN KEY (`training_field_id`) REFERENCES `training_fields` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_employee_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,2,1,'081234567801','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(2,3,2,'081234567802','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(3,4,3,'081234567803','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(4,5,1,'081234567804','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(5,6,2,'081234567805','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(6,7,3,'081234567806','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(7,8,1,'081234567807','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(8,9,2,'081234567808','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(9,10,3,'081234567809','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40'),(10,11,1,'081234567810','Instruktur','Kabupaten Ngawi','2026-07-12 23:22:40','2026-07-12 23:22:40');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text,
  `education` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `fk_participant_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
INSERT INTO `participants` VALUES (1,12,'081234567801','L','2003-01-01','Banjarmasin','SMA/SMK','Belum Bekerja','2026-07-12 23:22:40','2026-07-12 23:22:40');
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `training_id` int NOT NULL,
  `motivation` text,
  `status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `approved_by` int DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_by` int DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `rejected_reason` text,
  `completed_by` int DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_registration_user` (`user_id`),
  KEY `fk_registration_training` (`training_id`),
  KEY `fk_registration_approved_by` (`approved_by`),
  KEY `fk_registration_rejected_by` (`rejected_by`),
  KEY `fk_registration_completed_by` (`completed_by`),
  CONSTRAINT `fk_registration_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_registration_completed_by` FOREIGN KEY (`completed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_registration_rejected_by` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_registration_training` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_registration_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrations`
--

LOCK TABLES `registrations` WRITE;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_id` int NOT NULL,
  `trainer_id` int NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `location` varchar(150) NOT NULL,
  `room` varchar(100) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `max_participants` int NOT NULL DEFAULT '30',
  `notes` text,
  `status` enum('draft','scheduled','ongoing','completed','cancelled') DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_schedule_training` (`training_id`),
  KEY `fk_schedule_trainer` (`trainer_id`),
  CONSTRAINT `fk_schedule_trainer` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_schedule_training` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,1,5,'Gatau','Banjarbaru','23','2026-07-08','2026-07-28','00:30:00','07:35:00',30,'Latihan weee\r\n','scheduled','2026-07-12 23:30:43','2026-07-12 23:30:43');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainers`
--

DROP TABLE IF EXISTS `trainers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trainers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_field_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `expertise` varchar(150) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `biography` text,
  `avatar` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_trainer_training_field` (`training_field_id`),
  CONSTRAINT `fk_trainer_training_field` FOREIGN KEY (`training_field_id`) REFERENCES `training_fields` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainers`
--

LOCK TABLES `trainers` WRITE;
/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
INSERT INTO `trainers` VALUES (1,1,'Natasya Deviana, S.Kom','081234567890','tasya.deviana@diskop.go.id','DISKOP UKM','Web Programming',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(2,1,'Michee Puding','081234567891','nata.devi@ulm.ac.id','Universitas Lambung Mangkurat','Web Development',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(3,1,'Natasya','081234567892','deviana.tasya@gmail.com','DISKOP UKM','Database Administration',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(4,1,'Deviana','081234567893','devi.nata@gmail.com','Kominfo','Networking',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(5,1,'Tasya','081234567894','tasya.nata@gmail.com','Politeknik Negeri Banjarmasin','Cyber Security',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(6,2,'Devi','081234567895','devi.tasya@gmail.com','PT United Tractors','Operator Excavator',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(7,2,'Nata Deviana','081234567896','nata.deviana@gmail.com','PT PAMA Persada','Operator Bulldozer',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(8,2,'Deviana','081234567897','deviana.devi@gmail.com','PT Adaro Indonesia','Heavy Equipment Maintenance',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(9,3,'Tasya Puding','081234567898','tasya.devi@gmail.com','POLDA KALSEL','Security Awareness',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(10,3,'Nata Michee','081234567899','nata.tasya@gmail.com','BNSP','Security Management',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(11,3,'Natasyaa','081234567900','deviana.nata@gmail.com','Basarnas','Emergency Response',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40'),(12,3,'Deviana 10','081234567901','devi.deviana@gmail.com','DISKOP UKM','Public Safety',NULL,NULL,NULL,'active','2026-07-12 23:22:40','2026-07-12 23:22:40');
/*!40000 ALTER TABLE `trainers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_fields`
--

DROP TABLE IF EXISTS `training_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_fields` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `icon` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training_fields`
--

LOCK TABLES `training_fields` WRITE;
/*!40000 ALTER TABLE `training_fields` DISABLE KEYS */;
INSERT INTO `training_fields` VALUES (1,'Komputer','Pelatihan bidang komputer','fas fa-laptop','primary',1,'2026-07-12 23:22:40','2026-07-12 23:22:40'),(2,'Alat Berat','Operator alat berat','fas fa-truck-moving','success',1,'2026-07-12 23:22:40','2026-07-12 23:22:40'),(3,'Security','Pelatihan keamanan','fas fa-user-shield','warning',1,'2026-07-12 23:22:40','2026-07-12 23:22:40');
/*!40000 ALTER TABLE `training_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainings`
--

DROP TABLE IF EXISTS `trainings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trainings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_field_id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  `quota` int DEFAULT '0',
  `duration` int DEFAULT '0',
  `location` varchar(255) DEFAULT NULL,
  `registration_open` date DEFAULT NULL,
  `registration_close` date DEFAULT NULL,
  `status` enum('draft','open','closed') DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `training_field_id` (`training_field_id`),
  CONSTRAINT `trainings_ibfk_1` FOREIGN KEY (`training_field_id`) REFERENCES `training_fields` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainings`
--

LOCK TABLES `trainings` WRITE;
/*!40000 ALTER TABLE `trainings` DISABLE KEYS */;
INSERT INTO `trainings` VALUES (1,1,'Web Programming','Belajar PHP, HTML, CSS, JavaScript',25,30,'DISKOP','2026-07-01','2026-07-31','open','2026-07-12 23:22:40','2026-07-12 23:22:40'),(2,2,'Operator Forklift','Pelatihan operator forklift',20,14,'Workshop','2026-07-10','2026-08-01','open','2026-07-12 23:22:40','2026-07-12 23:22:40'),(3,3,'Gada Pratama','Pelatihan Satpam',30,21,'Aula DISKOP','2026-07-15','2026-08-10','open','2026-07-12 23:22:40','2026-07-12 23:22:40');
/*!40000 ALTER TABLE `trainings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pegawai','peserta') NOT NULL DEFAULT 'peserta',
  `status` enum('active','inactive','blocked') NOT NULL DEFAULT 'active',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin','admin@diskop.test',NULL,'$2y$10$ah/BWuoI7L7DeaIgQgg7mOJ2p2dYxsftyYIDvp6.bOuxyPXgnZqpm','admin','active',NULL,'2026-07-12 23:22:39','2026-07-12 23:22:39'),(2,'Pegawai 1','pegawai1','pegawai1@diskop.test',NULL,'$2y$10$zRQjtbTzPRieAUKHT0Y71uObjdDbIyiwQ629NVBXZlodBYjftAQhO','pegawai','active','2026-07-12 23:40:19','2026-07-12 23:22:39','2026-07-12 23:40:19'),(3,'Pegawai 2','pegawai2','pegawai2@diskop.test',NULL,'$2y$10$JCvljJJxAppW6cRBDaJBkulHZE7/NAOkMXk4nHymry9QG3nRPeVuy','pegawai','active',NULL,'2026-07-12 23:22:39','2026-07-12 23:22:39'),(4,'Pegawai 3','pegawai3','pegawai3@diskop.test',NULL,'$2y$10$sXwySOU1FgY8enLTGXN5re.Ba6wUspeC3MIg8jsJxtw97kIK.U9ZS','pegawai','active',NULL,'2026-07-12 23:22:39','2026-07-12 23:22:39'),(5,'Pegawai 4','pegawai4','pegawai4@diskop.test',NULL,'$2y$10$N0j1rKwW0f2KHQc6Wd9NQOwjI8/Zmvei6AmfBa1I1WVNyu13v2YtW','pegawai','active',NULL,'2026-07-12 23:22:39','2026-07-12 23:22:39'),(6,'Pegawai 5','pegawai5','pegawai5@diskop.test',NULL,'$2y$10$OxQn691L53HxfTq.VWd6meQ9Wm1rPDme7cJRvOFzx.TSqY1QKo15G','pegawai','active',NULL,'2026-07-12 23:22:39','2026-07-12 23:22:39'),(7,'Pegawai 6','pegawai6','pegawai6@diskop.test',NULL,'$2y$10$p/i.uURPVkP6iBfVsuLAR.vQtIuSNuRAN/SEuKFa1qAv5gr7c7lbi','pegawai','active',NULL,'2026-07-12 23:22:39','2026-07-12 23:22:39'),(8,'Pegawai 7','pegawai7','pegawai7@diskop.test',NULL,'$2y$10$o.NiF/3V1Mq7bC1fNXW4tuN58sVNGQIQCoFrVpryImH9.yMGZaU1e','pegawai','active',NULL,'2026-07-12 23:22:40','2026-07-12 23:22:40'),(9,'Pegawai 8','pegawai8','pegawai8@diskop.test',NULL,'$2y$10$zB2eX2mtSNc3CVJhd.M9w.XQT7Q7eb/0XyjLTr5CQLFWbUh6BRyp2','pegawai','active',NULL,'2026-07-12 23:22:40','2026-07-12 23:22:40'),(10,'Pegawai 9','pegawai9','pegawai9@diskop.test',NULL,'$2y$10$/cLnXrHT2ckhUbNPzU66sOtrGWecGYBVFbfDVZK7/ay2TLz7/7qnm','pegawai','active',NULL,'2026-07-12 23:22:40','2026-07-12 23:22:40'),(11,'Pegawai 10','pegawai10','pegawai10@diskop.test',NULL,'$2y$10$d8Xc5wshA/OVT6KhNjSn2uqIUEnTTAtYhEMlfttSQXqdWoPpnQBhy','pegawai','active',NULL,'2026-07-12 23:22:40','2026-07-12 23:22:40'),(12,'Peserta Demo','peserta','peserta@diskop.test',NULL,'$2y$10$zzVgrDn5Rt3nWqCwt9nu3uV5KWeVJtfCDQ81YP2aOgrWX3diKCiie','peserta','active','2026-07-12 23:40:36','2026-07-12 23:22:40','2026-07-12 23:40:36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-13  7:42:17
