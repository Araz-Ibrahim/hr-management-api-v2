-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hr_management
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `employee_jobs`
--

DROP TABLE IF EXISTS `employee_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_jobs_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_jobs`
--

LOCK TABLES `employee_jobs` WRITE;
/*!40000 ALTER TABLE `employee_jobs` DISABLE KEYS */;
INSERT INTO `employee_jobs` VALUES (1,'Founder','2024-03-30 08:27:20','2024-03-30 08:27:20'),(2,'Gas Pumping Station Operator','2024-03-30 08:27:20','2024-03-30 08:27:20'),(3,'Forensic Science Technician','2024-03-30 08:27:20','2024-03-30 08:27:20'),(4,'Buffing and Polishing Operator','2024-03-30 08:27:20','2024-03-30 08:27:20'),(5,'update title','2024-03-30 08:27:20','2024-03-30 10:21:19'),(6,'Actuary','2024-03-30 08:27:20','2024-03-30 08:27:20'),(7,'Programmer','2024-03-30 10:19:55','2024-03-30 10:19:55'),(8,'Furniture Finisher','2024-03-30 10:19:55','2024-03-30 10:19:55'),(9,'Softwear','2024-03-30 10:21:09','2024-03-30 10:21:09');
/*!40000 ALTER TABLE `employee_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_logs`
--

DROP TABLE IF EXISTS `employee_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `changes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`changes`)),
  `employee_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_logs`
--

LOCK TABLES `employee_logs` WRITE;
/*!40000 ALTER TABLE `employee_logs` DISABLE KEYS */;
INSERT INTO `employee_logs` VALUES (1,'deleted','[]',4,1,'2024-03-30 08:28:07','2024-03-30 08:28:07'),(2,'created','[]',32,1,'2024-03-30 09:20:34','2024-03-30 09:20:34'),(3,'created','[]',33,1,'2024-03-30 10:12:16','2024-03-30 10:12:16'),(4,'updated','{\"name\":{\"old\":\"Clemmie Roob\",\"new\":\"mr new\"},\"email\":{\"old\":\"maximillia.sawayn@romaguera.com\",\"new\":\"new@example.com\"},\"manager_id\":{\"old\":null,\"new\":1},\"job_id\":{\"old\":4,\"new\":3},\"salary\":{\"old\":7000,\"new\":10000}}',10,1,'2024-03-30 10:13:03','2024-03-30 10:13:03'),(5,'deleted','[]',10,1,'2024-03-30 10:13:20','2024-03-30 10:13:20'),(6,'created','[]',34,1,'2024-03-30 10:19:55','2024-03-30 10:19:55'),(7,'created','[]',35,1,'2024-03-30 10:19:55','2024-03-30 10:19:55'),(8,'created','[]',36,1,'2024-03-30 10:19:55','2024-03-30 10:19:55'),(9,'created','[]',37,1,'2024-03-30 10:19:55','2024-03-30 10:19:55');
/*!40000 ALTER TABLE `employee_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `manager_id` bigint(20) unsigned DEFAULT NULL,
  `job_id` bigint(20) unsigned NOT NULL,
  `salary` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`),
  KEY `employees_manager_id_foreign` (`manager_id`),
  KEY `employees_job_id_foreign` (`job_id`),
  CONSTRAINT `employees_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `employee_jobs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employees_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Founder','ebotsford@hill.com',NULL,1,100000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(2,'Elouise Skiles','lesley60@conn.com',1,2,4000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(3,'Dr. Jerome Thompson Sr.','hermiston.betsy@upton.com',1,2,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(5,'Prof. Claire Pollich','hirthe.mekhi@hotmail.com',1,2,5000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(6,'Trudie Romaguera','clyde24@dach.com',1,2,7000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(7,'Anabelle Barton MD','hkovacek@yahoo.com',2,5,7000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(8,'Ewell Cormier III','hkeeling@witting.biz',2,4,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(9,'Evan Keeling II','buster95@gmail.com',5,4,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(11,'Meggie Stroman','ondricka.gay@yahoo.com',6,5,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(12,'Isabelle Mueller','brandyn95@gmail.com',NULL,5,4000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(13,'Amber Little I','terrence.zboncak@gmail.com',NULL,4,4000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(14,'Juwan Lindgren','runolfsson.david@walsh.net',2,3,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(15,'Jordyn Barrows DVM','devin.hane@white.net',6,5,7000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(16,'Mrs. Frederique Schaden','christy63@yahoo.com',2,4,4000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(17,'Mr. Dashawn Conroy DDS','lgreenholt@hotmail.com',5,4,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(18,'Ms. Clotilde Klocko','ziemann.lucie@yahoo.com',2,3,6000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(19,'Ottilie Mayer','zfritsch@gmail.com',2,3,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(20,'Jadon Ankunding III','shaina01@stanton.com',5,2,7000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(21,'Dr. Geovanny Heathcote I','pmarvin@luettgen.com',NULL,6,7000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(22,'Jana Schiller','duane.harris@medhurst.info',NULL,6,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(23,'Yasmin Reilly','wehner.ardella@yahoo.com',NULL,6,5000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(24,'Dr. Caitlyn Gorczany Jr.','malachi.johnson@hickle.com',2,6,7000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(25,'Charlie Buckridge','blick.filomena@jacobi.com',3,2,5000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(26,'Miss Celia White PhD','lwiza@yahoo.com',3,3,5000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(27,'Ellsworth Ratke','chelsea53@gmail.com',3,6,4000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(28,'Mrs. Mya Tromp','deontae94@gmail.com',3,5,6000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(29,'Giles Bins','kirlin.kristian@yahoo.com',5,2,8000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(30,'Velda Willms','iliana07@gmail.com',6,5,4000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(31,'Sebastian Haley IV','nschulist@klein.biz',NULL,6,4000,'2024-03-30 08:27:20','2024-03-30 08:27:20'),(32,'araz ibrahim','araz@gmail.com',3,2,90000,'2024-03-30 09:20:34','2024-03-30 09:20:34'),(33,'araz ibrahim','new@gmail.com',3,2,90000,'2024-03-30 10:12:16','2024-03-30 10:12:16'),(34,'Ahmad','ahmad@email.com',1,7,10000,'2024-03-30 10:19:55','2024-03-30 10:19:55'),(35,'Mr. lain','lain@email.com',1,8,7000,'2024-03-30 10:19:55','2024-03-30 10:19:55'),(36,'Miss lana.','lana@email.com',1,8,5000,'2024-03-30 10:19:55','2024-03-30 10:19:55'),(37,'toni','toni@email.com',1,7,6000,'2024-03-30 10:19:55','2024-03-30 10:19:55');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_03_28_095739_create_employee_table',2),(6,'2024_03_29_102307_create_employee_job_table',2),(7,'2024_03_29_135041_create_employee_logs_table',2),(8,'2030_foreign_key',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (4,'App\\Models\\User',2,'MyApp','8d3c470de87bbbc1276b557c22c298c76b61284fa5ccb56a603adce6378ada74','[\"*\"]',NULL,NULL,'2024-03-30 09:48:16','2024-03-30 09:48:16'),(7,'App\\Models\\User',1,'MyApp','2974cf60a772aa6c95531ce824e428cbb37c8a47d46ef3e75cffdfb6d783c9dc','[\"*\"]','2024-03-30 13:41:45',NULL,'2024-03-30 09:49:32','2024-03-30 13:41:45'),(8,'App\\Models\\User',1,'MyApp','87ad3b98e51f3eaf93db1fc3fa5287902c541303ce1b9fb9cbb88d00d9408504','[\"*\"]','2024-03-30 13:34:32',NULL,'2024-03-30 13:34:27','2024-03-30 13:34:32');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2024-03-30 08:27:20','$2y$12$gnk2IH/hIZT08InG0GZUuuI7uudPgz.cIedkKUGIKln0tX1tkP36C','CUaKNwSF1C','2024-03-30 08:27:20','2024-03-30 08:27:20'),(2,'test','test@gmail.com',NULL,'$2y$12$mommR6LqXs04BVKD1x3nO.C54Z0Ts9hfpP6jH8R.PMbvuX.IOnNdm',NULL,'2024-03-30 09:48:16','2024-03-30 09:48:16');
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

-- Dump completed on 2024-03-30 21:43:22
