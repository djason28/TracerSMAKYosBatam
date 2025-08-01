-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: tracer_yos
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel_cache_illuminate:queue:restart','i:1748955789;',2064315789),('laravel_cache_import-status:0ad1f762-da8f-4618-b9d5-84c5b155f677','s:17:\"no_new_data_admin\";',1748863942),('laravel_cache_import-status:0c717906-99bc-4cb1-81b5-351ae9a34a47','s:18:\"no_new_data_alumni\";',1748863952),('laravel_cache_import-status:11fb3450-3333-4393-b67d-3b181d00f68a','s:14:\"missing_fields\";',1748863986),('laravel_cache_import-status:13f8a997-4706-4251-a503-4c413733fc53','a:3:{s:6:\"status\";s:17:\"no_new_data_admin\";s:10:\"duplicates\";a:6:{i:0;s:15:\"admin@gmail.com\";i:1;s:18:\"admin123@gmail.com\";i:2;s:17:\"admin10@gmail.com\";i:3;s:20:\"adminbaru1@gmail.com\";i:4;s:20:\"adminbaru2@gmail.com\";i:5;s:20:\"adminbaru3@gmail.com\";}s:8:\"imported\";a:0:{}}',1749041655),('laravel_cache_import-status:186f2f38-bc10-4538-85b3-4331c1781c40','s:14:\"missing_fields\";',1748863942),('laravel_cache_import-status:2def26ee-d160-47b9-9b65-ddca7452fefa','a:3:{s:6:\"status\";s:7:\"no data\";s:10:\"duplicates\";a:0:{}s:8:\"imported\";a:0:{}}',1749089647),('laravel_cache_import-status:32cb1dc0-bedd-4896-ac20-6b34ab04e60c','a:3:{s:6:\"status\";s:4:\"done\";s:10:\"duplicates\";a:2:{i:0;s:4:\"0050\";i:1;s:4:\"8888\";}s:8:\"imported\";a:12:{i:0;s:4:\"0010\";i:1;s:4:\"0012\";i:2;s:4:\"0011\";i:3;s:4:\"0123\";i:4;s:4:\"0124\";i:5;s:4:\"0057\";i:6;s:4:\"0058\";i:7;s:4:\"0059\";i:8;s:4:\"0060\";i:9;s:4:\"0061\";i:10;s:4:\"0062\";i:11;s:4:\"0063\";}}',1748956798),('laravel_cache_import-status:3307d140-0ad5-44bf-9667-30bdd95a26e1','a:3:{s:6:\"status\";s:18:\"no_new_data_alumni\";s:10:\"duplicates\";a:1:{i:0;s:4:\"0050\";}s:8:\"imported\";a:0:{}}',1748956735),('laravel_cache_import-status:3d7ef4c9-74e7-44e8-918e-c5672d9bc1f4','s:14:\"missing_fields\";',1748844446),('laravel_cache_import-status:42230b2a-f796-4eac-8676-94a27b80c86d','s:4:\"done\";',1748955629),('laravel_cache_import-status:44687762-7d1a-4773-b7b1-78d122e20b73','s:14:\"missing_fields\";',1748864007),('laravel_cache_import-status:46a3c6c1-a4d4-4d96-b0ff-ae65b286259d','s:17:\"no_new_data_admin\";',1748955943),('laravel_cache_import-status:5ffacad7-3687-44bc-b197-9ddb56b07679','a:3:{s:6:\"status\";s:7:\"no data\";s:10:\"duplicates\";a:0:{}s:8:\"imported\";a:0:{}}',1749089578),('laravel_cache_import-status:65d62712-1261-4ec0-aab7-f3170b4753bc','a:3:{s:6:\"status\";s:4:\"done\";s:10:\"duplicates\";a:3:{i:0;s:15:\"admin@gmail.com\";i:1;s:20:\"adminbaru2@gmail.com\";i:2;s:20:\"adminbaru3@gmail.com\";}s:8:\"imported\";a:3:{i:0;s:18:\"admin123@gmail.com\";i:1;s:17:\"admin10@gmail.com\";i:2;s:20:\"adminbaru1@gmail.com\";}}',1748956421),('laravel_cache_import-status:6eb974eb-9f15-4bdc-880b-65cd79f3579a','s:4:\"done\";',1748956013),('laravel_cache_import-status:7188ff00-c7e7-4f66-a318-5aad4f13e47d','a:3:{s:6:\"status\";s:7:\"no data\";s:10:\"duplicates\";a:0:{}s:8:\"imported\";a:0:{}}',1749089629),('laravel_cache_import-status:744d739c-7d20-487e-b05a-cf486dfcbea7','a:3:{s:6:\"status\";s:17:\"no_new_data_admin\";s:10:\"duplicates\";a:6:{i:0;s:15:\"admin@gmail.com\";i:1;s:18:\"admin123@gmail.com\";i:2;s:17:\"admin10@gmail.com\";i:3;s:20:\"adminbaru1@gmail.com\";i:4;s:20:\"adminbaru2@gmail.com\";i:5;s:20:\"adminbaru3@gmail.com\";}s:8:\"imported\";a:0:{}}',1749041480),('laravel_cache_import-status:78362bdd-9220-43d7-b199-ceac8b24fd0c','s:4:\"done\";',1748844262),('laravel_cache_import-status:7fd855e0-4c84-4078-a32f-94939ccbeebf','s:4:\"done\";',1748955237),('laravel_cache_import-status:8ff1c877-c4be-4b89-ae87-d9e65ecdf913','s:4:\"done\";',1748844425),('laravel_cache_import-status:9527b947-149b-4c0a-84fc-ed079bd4accd','s:14:\"missing_fields\";',1748863942),('laravel_cache_import-status:9c70d610-b45b-4360-91e8-1cc6fb55091c','s:18:\"no_new_data_alumni\";',1748864902),('laravel_cache_import-status:9c899f82-4142-48b6-89bc-6deb5b6f3243','s:17:\"no_new_data_admin\";',1748955687),('laravel_cache_import-status:a10d8821-a352-4196-abfc-faaee65527fc','s:17:\"no_new_data_admin\";',1748955644),('laravel_cache_import-status:a2139fb2-a931-4cb5-96f6-b52738889e6d','a:3:{s:6:\"status\";s:4:\"done\";s:10:\"duplicates\";a:1:{i:0;s:15:\"admin@gmail.com\";}s:8:\"imported\";a:5:{i:0;s:18:\"admin123@gmail.com\";i:1;s:17:\"admin10@gmail.com\";i:2;s:20:\"adminbaru1@gmail.com\";i:3;s:20:\"adminbaru2@gmail.com\";i:4;s:20:\"adminbaru3@gmail.com\";}}',1748956443),('laravel_cache_import-status:b8a3cce6-983a-48c4-8e7b-fc0baa37386e','s:17:\"no_new_data_admin\";',1748956212),('laravel_cache_import-status:b8e7ceae-3ee7-4a92-8024-57a0f64f2596','a:3:{s:6:\"status\";s:17:\"no_new_data_admin\";s:10:\"duplicates\";a:6:{i:0;s:15:\"admin@gmail.com\";i:1;s:18:\"admin123@gmail.com\";i:2;s:17:\"admin10@gmail.com\";i:3;s:20:\"adminbaru1@gmail.com\";i:4;s:20:\"adminbaru2@gmail.com\";i:5;s:20:\"adminbaru3@gmail.com\";}s:8:\"imported\";a:0:{}}',1748956402),('laravel_cache_import-status:c0f4c86e-8c1f-4930-b3e8-b392fee05760','a:3:{s:6:\"status\";s:17:\"no_new_data_admin\";s:10:\"duplicates\";a:6:{i:0;s:15:\"admin@gmail.com\";i:1;s:18:\"admin123@gmail.com\";i:2;s:17:\"admin10@gmail.com\";i:3;s:20:\"adminbaru1@gmail.com\";i:4;s:20:\"adminbaru2@gmail.com\";i:5;s:20:\"adminbaru3@gmail.com\";}s:8:\"imported\";a:0:{}}',1749041489),('laravel_cache_import-status:cdef32ac-dc8f-413b-8fed-3203ca425368','a:3:{s:6:\"status\";s:7:\"no data\";s:10:\"duplicates\";a:0:{}s:8:\"imported\";a:0:{}}',1749089560),('laravel_cache_import-status:d333eabd-b21e-4378-9b45-ca1f787b3b50','s:4:\"done\";',1748863943),('laravel_cache_import-status:d352092c-11a9-4aca-b5e8-212ca8d307ce','s:17:\"no_new_data_admin\";',1748844440),('laravel_cache_import-status:ddb704d4-b5d2-407d-80bc-7c9f3553772e','s:7:\"pending\";',1748956414),('laravel_cache_import-status:e1b62a05-6adc-4ad7-be72-b1c2a20d13a4','a:3:{s:6:\"status\";s:7:\"no data\";s:10:\"duplicates\";a:0:{}s:8:\"imported\";a:0:{}}',1749089948),('laravel_cache_import-status:e1e709ef-308c-42e9-92b3-b9497b532992','s:7:\"pending\";',1748956391),('laravel_cache_import-status:e405d4c9-170c-4cd8-ac2f-ebb89073689d','s:4:\"done\";',1748955672),('laravel_cache_import-status:e66b1615-cb69-45e8-8741-ab0c104ec171','s:14:\"missing_fields\";',1748863942),('laravel_cache_import-status:f2857d3b-5953-464d-88ab-e88ac6f70786','s:14:\"missing_fields\";',1748864052),('laravel_cache_import-status:fe5ade00-d8d3-49e2-b613-539d0977970e','s:4:\"done\";',1748863971);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
INSERT INTO `failed_jobs` VALUES (1,'4b598cd8-dbdc-481a-a204-9906e88f1636','database','imports','{\"uuid\":\"4b598cd8-dbdc-481a-a204-9906e88f1636\",\"displayName\":\"App\\\\Jobs\\\\ImportAdmin\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ImportAdmin\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\ImportAdmin\\\":4:{s:5:\\\"jobId\\\";s:53:\\\"imports\\/l4ixkFwxUw8ML8qgfBOsT0bkB6aO54nH7RZgJiyT.xlsx\\\";s:11:\\\"\\u0000*\\u0000filePath\\\";s:36:\\\"e1e709ef-308c-42e9-92b3-b9497b532992\\\";s:5:\\\"queue\\\";s:7:\\\"imports\\\";s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-06-03 12:43:11.556205\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\"}}','Maatwebsite\\Excel\\Exceptions\\NoTypeDetectedException: No ReaderType or WriterType could be detected. Make sure you either pass a valid extension to the filename or pass an explicit type. in C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\maatwebsite\\excel\\src\\Helpers\\FileTypeDetector.php:31\nStack trace:\n#0 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\maatwebsite\\excel\\src\\Excel.php(154): Maatwebsite\\Excel\\Helpers\\FileTypeDetector::detect(\'C:\\\\Users\\\\DJason...\', NULL)\n#1 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Maatwebsite\\Excel\\Excel->import(Object(App\\Imports\\AdminImport), \'C:\\\\Users\\\\DJason...\')\n#2 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\app\\Jobs\\ImportAdmin.php(42): Illuminate\\Support\\Facades\\Facade::__callStatic(\'import\', Array)\n#3 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\ImportAdmin->handle()\n#4 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#6 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#7 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#8 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(125): Illuminate\\Container\\Container->call(Array)\n#9 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\ImportAdmin))\n#10 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportAdmin))\n#11 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#12 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\ImportAdmin), false)\n#13 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\ImportAdmin))\n#14 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportAdmin))\n#15 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#16 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\ImportAdmin))\n#17 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#18 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(391): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#20 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(177): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'imports\', Object(Illuminate\\Queue\\WorkerOptions))\n#22 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'imports\')\n#23 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#26 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#27 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#28 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#29 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\symfony\\console\\Command\\Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#31 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\symfony\\console\\Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\symfony\\console\\Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\symfony\\console\\Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#36 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#37 {main}','2025-06-03 05:43:14'),(2,'86ffb817-6ad9-4942-a95f-d6a05c5e2ed8','database','imports','{\"uuid\":\"86ffb817-6ad9-4942-a95f-d6a05c5e2ed8\",\"displayName\":\"App\\\\Jobs\\\\ImportAdmin\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"60,120,300\",\"timeout\":1200,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ImportAdmin\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\ImportAdmin\\\":4:{s:4:\\\"path\\\";s:53:\\\"imports\\/xlRhC2FhEbcwkgPxic5nsR1emDi4SjM88njsPCFZ.xlsx\\\";s:5:\\\"jobId\\\";s:36:\\\"ddb704d4-b5d2-407d-80bc-7c9f3553772e\\\";s:5:\\\"queue\\\";s:7:\\\"imports\\\";s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-06-03 12:43:34.902201\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\"}}','Error: Typed property App\\Jobs\\ImportAdmin::$filePath must not be accessed before initialization in C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\app\\Jobs\\ImportAdmin.php:38\nStack trace:\n#0 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\ImportAdmin->handle()\n#1 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#3 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#4 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#5 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(125): Illuminate\\Container\\Container->call(Array)\n#6 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\ImportAdmin))\n#7 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportAdmin))\n#8 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#9 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\ImportAdmin), false)\n#10 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\ImportAdmin))\n#11 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportAdmin))\n#12 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#13 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\ImportAdmin))\n#14 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#15 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(391): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#17 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(177): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#18 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'imports\', Object(Illuminate\\Queue\\WorkerOptions))\n#19 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'imports\')\n#20 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#23 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#24 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#25 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#26 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\symfony\\console\\Command\\Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#27 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#28 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\symfony\\console\\Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#29 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\symfony\\console\\Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#30 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\symfony\\console\\Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 C:\\Users\\DJason28\\Desktop\\DJason28\\Files\\School\\semester 6\\KP\\NewestTracer\\Tracer\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#34 {main}','2025-06-03 05:43:35');
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_04_18_092647_add_role_to_users_table',1),(5,'2025_04_18_093348_create_personal_access_tokens_table',1),(6,'2025_04_18_100521_add_role_to_users_table',1),(7,'2025_04_18_100535_add_role_to_users_table',1),(8,'2025_04_20_093636_add_role_to_users_table',1),(9,'2025_05_10_112313_add_nisn_and_alamat_to_users_table',1),(10,'2025_05_27_154056_update_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',1,'auth_token','67ce480f1cc993e695eb76af4a90ca51488cd1a84fbb120da8d69c31e2083b39','[\"*\"]','2025-06-01 22:54:56',NULL,'2025-06-01 22:52:47','2025-06-01 22:54:56'),(2,'App\\Models\\User',4,'auth_token','1c9d990e6ad89eb0436ff14075bbb60b7ad845a5697747aab0a972b7db8af7aa','[\"*\"]',NULL,NULL,'2025-06-01 22:58:20','2025-06-01 22:58:20'),(3,'App\\Models\\User',4,'auth_token','c35b01a4fc104e46dbd855d4c4ea6db1675e3e0e0bffa84dade2dd3c746702b3','[\"*\"]',NULL,NULL,'2025-06-02 04:16:51','2025-06-02 04:16:51'),(4,'App\\Models\\User',1,'auth_token','18f1bab0bfaa1639fed25f0113557bccfbf0734a594db71e7294466e57686727','[\"*\"]','2025-06-02 04:23:43',NULL,'2025-06-02 04:17:32','2025-06-02 04:23:43'),(5,'App\\Models\\User',1,'auth_token','fe7bfcd70ba4b7dc2229971ce2b5b0d6109a2576e988933edd703f85bc8a1423','[\"*\"]',NULL,NULL,'2025-06-02 04:30:36','2025-06-02 04:30:36'),(6,'App\\Models\\User',1,'auth_token','489bfcfffa707992751a6b0a64a84dc869fdb2f4ea8581fb53ec18e74d2b38c5','[\"*\"]','2025-06-02 04:31:51',NULL,'2025-06-02 04:31:35','2025-06-02 04:31:51'),(7,'App\\Models\\User',250,'auth_token','ea0d69f54087f386fc73e9fa1bd5a6c390761c065e97ebdaba06a550b106c3c3','[\"*\"]',NULL,NULL,'2025-06-02 04:32:22','2025-06-02 04:32:22'),(8,'App\\Models\\User',250,'auth_token','6480633eeb4cb581590dc1be2d35f972a2787b1af3ce80f3b564f06dde966db8','[\"*\"]',NULL,NULL,'2025-06-02 04:33:49','2025-06-02 04:33:49'),(9,'App\\Models\\User',1,'auth_token','ed9a662fe3a666bbe34e9b7fc1612b527923b7a139001bdea79fd043d548f4fc','[\"*\"]',NULL,NULL,'2025-06-02 04:34:11','2025-06-02 04:34:11'),(10,'App\\Models\\User',1,'auth_token','14517900c1159eb1596ae5801889b4fa5e8685c8d5eadaaededd2de1c20e0dc8','[\"*\"]','2025-06-03 06:08:18',NULL,'2025-06-03 05:41:12','2025-06-03 06:08:18'),(11,'App\\Models\\User',1,'auth_token','32250d3181639181ddd52703a5fbca2eaccb135d41fc8959f7546b530abc3565','[\"*\"]',NULL,NULL,'2025-06-04 04:43:15','2025-06-04 04:43:15'),(12,'App\\Models\\User',1,'auth_token','6fdc3c514f140162c9fb7da2fc0883830dcc0318e373861ef80e74da3918f13e','[\"*\"]',NULL,NULL,'2025-06-04 05:40:24','2025-06-04 05:40:24'),(13,'App\\Models\\User',9,'auth_token','6a8fdbad96351e8250185c5fcc49deb41c12ca81cefd71783c8e0e2653bf9e09','[\"*\"]',NULL,NULL,'2025-06-04 18:51:19','2025-06-04 18:51:19'),(14,'App\\Models\\User',1,'auth_token','1d4a0ca2ee8dc85b2872e32ee5ecfd4bc20481b06fca63b207ede2ff04b95fd6','[\"*\"]',NULL,NULL,'2025-06-04 18:59:46','2025-06-04 18:59:46');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('mETJL1I827rEaGreFUV2T08bwsRhJ550IDMFT7ku',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiellhZ0Jnd0doc2RtSjhjTUVrdTRITUMwVnM5eDJRRnNIaUpCOWxHRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qb2JzL3N0YXR1cy9lMWI2MmEwNS02YWRjLTRhZDctYmU3Mi1iMWMyYTIwZDEzYTQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1749089527);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'alumni',
  `nis` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `insta` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_place` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `graduation_year` int DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=288 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@gmail.com','2025-06-01 22:52:25','$2y$12$h0EStrdWuw/WCg7d8rEFfuo92vjIfAeQYPgHhYf/JanUq31Fwjnva','Gdo1k2oY0bbqDXRcBqDXO9ajcRIjLTR1mPsHUkRS4IvbWQsI1fALJ4jOLxeJ','2025-06-01 22:52:25','2025-06-01 22:52:25','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'People50',NULL,NULL,'$2y$12$WhGKZEy5XTyDwTdbSmR9Cui.cBxzme4brFMHdv.naW.x1gykllm6a',NULL,'2025-06-02 04:22:51','2025-06-02 04:22:51','alumni','0050',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'people001',NULL,NULL,'$2y$12$v8F9LtswFT4pj3kKca792.YiBtulLiSMo7c7sQleW//Szg8yrKDPS',NULL,'2025-06-02 04:23:44','2025-06-02 04:23:44','alumni','0001',NULL,NULL,NULL,NULL,', ',NULL,NULL,NULL),(229,'Siswa1','1@gmail.com',NULL,'$2y$12$4Bjfki9A5xujQZgreurAUOZx.VQesQFWPxx8EmS68tyvquoZMAWPO',NULL,'2025-06-01 08:24:03','2025-06-01 08:26:01','alumni','0001','2000-01-01','ins1','Batam Tourism Polytechnic (BTP)','jabaran','kerja, Batam',2020,'23456','Sistem Informasi'),(244,'Siswa16','16@gmail.com',NULL,'$2y$12$oV4f0cZUIUSGmPLkjmkYyObwrhSPw.REOz1DKVyd2uP2epGxynijy',NULL,'2025-06-01 08:24:10','2025-06-01 08:40:21','alumni','0016','2000-02-02','ins16','Belum Kuliah','Belum Kerja','Belum Kerja, Belum Kerja',2019,'456789','Belum Kuliah'),(245,'Siswa17','17@gmail.com',NULL,'$2y$12$xXCYv7obOQ36flqGMOo29OmjzTJVAuDm3gmNx/LJgX1MlJ.pzj8XC',NULL,'2025-06-01 08:24:10','2025-06-01 08:39:15','alumni','0017','2005-05-05','ins17','Batam Tourism Polytechnic (BTP)','Belum Kerja','Belum Kerja, Belum Kerja',2018,'123456765','Administrasi Bisnis'),(246,'Siswa18','18@gmail.com',NULL,'$2y$12$E5np9VZtPxjsyERHPY9UM.vn7hAxRLCNqz2EIDpDtK2srbffiKPAW',NULL,'2025-06-01 08:24:11','2025-06-01 08:36:19','alumni','0018','2005-04-04','ins18','Belum Kuliah','Belum Kerja','Belum Kerja, Belum Kerja',2021,'12345676543','Belum Kuliah'),(247,'Siswa19','19@gmail.com',NULL,'$2y$12$3ACrqlsa93IwD6SNax6Gru5HdUyItufTyu39SI1n4W0LR21WdrB4.',NULL,'2025-06-01 08:24:11','2025-06-01 08:28:46','alumni','0019','2005-04-04','ins19','Universitas Putera Batam (UPB)','jabatan','kerja, Batam',2021,'9876545678','Akuntansi'),(248,'Siswa20','20@gmail.com',NULL,'$2y$12$9ZF65shnLw04p/5GcVvQQebWMQ9.Rlf0c15iDiJl4GzxEhjR6YhCq',NULL,'2025-06-01 08:24:12','2025-06-01 08:27:57','alumni','0020','2005-03-03','ins20','Universitas Putera Batam (UPB)','jabatan','kerja, Batam',2021,'456789000','Manajemen'),(249,'Siswa21','2@gmail.com',NULL,'$2y$12$VSJK2TWW.2sW6hbrowLMqeyuhnyAUfqEYaI4OF1Rmumq7yZ/OXOZS',NULL,'2025-06-01 08:24:12','2025-06-01 08:45:02','alumni','0021','2000-01-01','ins2','Batam Tourism Polytechnic (BTP)','JWBDA','KERJA, Batam',2020,'12345699','Sistem Informasi'),(250,'Delvin','delvinjason.game02@gmail.com',NULL,'$2y$12$IdaiIBw8DZQWTCYE2NVvHe6xKSZqEsog1U3PrJEWHolrMKLRGV3Mq','vbx7VkkQBdNvREJFizisQEx4TCSTFHwjL0IHuepnynoyYDsiDDfp0RUo3NoS','2025-06-02 04:31:51','2025-06-02 04:33:36','alumni','1234','2000-01-28','djason281','Asia Pacific University of Technology & Innovation (APU)','Manager','PT. Cinta Nusantara, Amsterdam',2011,'085283918338','Administrasi Bisnis'),(270,'admin123','admin123@gmail.com',NULL,'$2y$12$xzE.HAAFCh6BF1/4zOdgme3JnZLg1LtTKcLFpsGtFxJ5rDazZK9PK',NULL,'2025-06-03 06:04:02','2025-06-03 06:04:02','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(271,'Admin10','admin10@gmail.com',NULL,'$2y$12$o6qNZyxER5GzXe4yukaUzOMBWcFDtKOHC0dmf6D4kh9MTOlgIvhFi',NULL,'2025-06-03 06:04:02','2025-06-03 06:04:02','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(272,'adminbaru','adminbaru1@gmail.com',NULL,'$2y$12$eaGxMdEHW69bjwLu3sTZSeMvfydpIo8eVmf27Sgx27RAMj.My1LTu',NULL,'2025-06-03 06:04:02','2025-06-03 06:04:02','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(273,'adminbaru1','adminbaru2@gmail.com',NULL,'$2y$12$4K.tplpDKPHUt3nJQurn4e/xJ1n6lLI0tA8mbXqQfvjBfcVXDd1cG',NULL,'2025-06-03 06:04:03','2025-06-03 06:04:03','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(274,'adminbaru2','adminbaru3@gmail.com',NULL,'$2y$12$veY2m.LaWbmOWverot6vyuqLqfb6TIVDtrku3TXfQSfGrrTjpf04C',NULL,'2025-06-03 06:04:03','2025-06-03 06:04:03','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(275,'Delvin','asdf@gmail.com',NULL,'$2y$12$1/Vj7zc0C2LPWsy0vmjTauRJpzqWNCU6RqrXkqC4egcH1v9LPlqSK',NULL,'2025-06-03 06:08:18','2025-06-03 06:08:48','alumni','8888','0001-01-01','djason281','Asia Pacific University of Technology & Innovation (APU)','Manager','PT. Cinta Nusantara, Amsterdam',NULL,'085283918330','Administrasi Bisnis'),(276,'People50',NULL,NULL,'$2y$12$P6LI0deUdrXAP.UoO1irLO6NyC0HPasXSuHDdPDoKTzrGOjFK1FC.',NULL,'2025-06-03 06:09:55','2025-06-03 06:09:55','alumni','0010',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(277,'People50',NULL,NULL,'$2y$12$PPbgTSfUJHiSM2ngmmMHVeDItvtdLzTdWSW/3vr07v5s3/MfnJH6u',NULL,'2025-06-03 06:09:56','2025-06-03 06:09:56','alumni','0012',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(278,'People50',NULL,NULL,'$2y$12$02jcjSq9EXWTRf5v76.6y.DvFffluVbL6aVENuQwy0NXiQZRU25EG',NULL,'2025-06-03 06:09:56','2025-06-03 06:09:56','alumni','0011',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(279,'People50',NULL,NULL,'$2y$12$8u3OUKQfa.lewPF9t7nlTePTwYdkmx7G0Acn6VMbjv377Nuyx6hSG',NULL,'2025-06-03 06:09:56','2025-06-03 06:09:56','alumni','0123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(280,'People50',NULL,NULL,'$2y$12$dtC9374Z31q5/W8ZkSawL.whktxKsCFTgpD1gv.Jz/51WjeLY3Cvq',NULL,'2025-06-03 06:09:56','2025-06-03 06:09:56','alumni','0124',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(281,'People50',NULL,NULL,'$2y$12$qvUKR7RxjjUsl5u13xeUS.HT.dVdFpaUy7rAKnpqnALL7St2QNf1G',NULL,'2025-06-03 06:09:56','2025-06-03 06:09:56','alumni','0057',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(282,'People50',NULL,NULL,'$2y$12$e3N9Oe9cw/.xYVkp2lkt2.ZNiCCVIW05JJdvuAfhumxq15UkmILxG',NULL,'2025-06-03 06:09:57','2025-06-03 06:09:57','alumni','0058',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(283,'People50',NULL,NULL,'$2y$12$I/ZqySml4WY..y.aP/boAezvLfXg4sVODrit.4TpctPoe5ksLvSNC',NULL,'2025-06-03 06:09:57','2025-06-03 06:09:57','alumni','0059',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(284,'People50',NULL,NULL,'$2y$12$BD7ru75uXiIqUXpvqoescOsxflEI3.viPN5rBVz95SMsgwBx1nlza',NULL,'2025-06-03 06:09:57','2025-06-03 06:09:57','alumni','0060',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(285,'People50',NULL,NULL,'$2y$12$D3EfKMzsc93bwdmensLszuJ/QzH7Wi1TiPXiKipKrZCeTLBj59uRW',NULL,'2025-06-03 06:09:57','2025-06-03 06:09:57','alumni','0061',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(286,'People50',NULL,NULL,'$2y$12$suE1vVKzxsEYSJuuvMfR/uVjhZaWkhusfBY9vXfBgYPPPPoxi8tg2',NULL,'2025-06-03 06:09:57','2025-06-03 06:09:57','alumni','0062',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(287,'People50',NULL,NULL,'$2y$12$ekY7U1CwAOfrMKOigMWqu.1ipDJkP5kGie1.tscrZjf5sWkeJoPf.',NULL,'2025-06-03 06:09:58','2025-06-03 06:09:58','alumni','0063',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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

-- Dump completed on 2025-06-23 19:32:14
