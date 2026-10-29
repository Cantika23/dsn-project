-- Backup of log_courier table created on 2025-07-20 08:50:22
-- For restoration, ensure the table exists before running these INSERT statements

-- Table structure
CREATE TABLE `log_courier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `awb` varchar(20) DEFAULT NULL,
  `kurir` varchar(5) DEFAULT NULL,
  `req_type` varchar(25) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `parameter` text,
  `response` varchar(10) DEFAULT NULL,
  `content` text,
  `text_query` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1420 DEFAULT CHARSET=utf8mb3;

-- Data for log_courier
INSERT INTO `log_courier` VALUES
("1347",NULL,NULL,"RESP_API","2025-02-01 08:20:31",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000018,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1348",NULL,NULL,"RESP_SAP","2025-02-02 14:15:47",NULL,"failed","{\"success\":false,\"status\":500,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000019,\"status\":0,\"message\":\"Server Error\"}]}",NULL),
("1349",NULL,NULL,"RESP_API","2025-03-01 10:30:22",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000020,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1350",NULL,NULL,"RESP_SAP","2025-03-02 09:10:34",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000021,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1351",NULL,NULL,"RESP_API","2025-04-01 13:25:58",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000022,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1352",NULL,NULL,"RESP_SAP","2025-04-02 08:40:12",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000023,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1353",NULL,NULL,"RESP_API","2025-05-01 08:15:23",NULL,"failed","{\"success\":false,\"status\":400,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000024,\"status\":0,\"message\":\"Invalid Data\"}]}",NULL),
("1354",NULL,NULL,"RESP_SAP","2025-05-02 12:30:45",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000025,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1355",NULL,NULL,"RESP_API","2025-06-01 09:45:12",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000026,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1356",NULL,NULL,"RESP_SAP","2025-06-02 14:20:33",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000027,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1357",NULL,NULL,"RESP_API","2025-07-01 11:10:57",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000028,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1358",NULL,NULL,"RESP_SAP","2025-07-02 16:25:19",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000029,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1359",NULL,NULL,"RESP_API","2025-07-03 10:05:44",NULL,"failed","{\"success\":false,\"status\":500,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000030,\"status\":0,\"message\":\"Server Error\"}]}",NULL),
("1377",NULL,NULL,"RESP_API","2025-02-01 08:20:31",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000018,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1378",NULL,NULL,"RESP_SAP","2025-02-02 14:15:47",NULL,"failed","{\"success\":false,\"status\":500,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000019,\"status\":0,\"message\":\"Server Error\"}]}",NULL),
("1379",NULL,NULL,"RESP_API","2025-03-01 10:30:22",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000020,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1380",NULL,NULL,"RESP_SAP","2025-03-02 09:10:34",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000021,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1381",NULL,NULL,"RESP_API","2025-04-01 13:25:58",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000022,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1382",NULL,NULL,"RESP_SAP","2025-04-02 08:40:12",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000023,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1383",NULL,NULL,"RESP_API","2025-05-01 08:15:23",NULL,"failed","{\"success\":false,\"status\":400,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000024,\"status\":0,\"message\":\"Invalid Data\"}]}",NULL),
("1384",NULL,NULL,"RESP_SAP","2025-05-02 12:30:45",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000025,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1385",NULL,NULL,"RESP_API","2025-06-01 09:45:12",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000026,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1386",NULL,NULL,"RESP_SAP","2025-06-02 14:20:33",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000027,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1387",NULL,NULL,"RESP_API","2025-07-01 11:10:57",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000028,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1388",NULL,NULL,"RESP_SAP","2025-07-02 16:25:19",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000029,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1389",NULL,NULL,"RESP_API","2025-07-03 10:05:44",NULL,"failed","{\"success\":false,\"status\":500,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000030,\"status\":0,\"message\":\"Server Error\"}]}",NULL),
("1407",NULL,NULL,"RESP_API","2025-02-01 08:20:31",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000018,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1408",NULL,NULL,"RESP_SAP","2025-02-02 14:15:47",NULL,"failed","{\"success\":false,\"status\":500,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000019,\"status\":0,\"message\":\"Server Error\"}]}",NULL),
("1409",NULL,NULL,"RESP_API","2025-03-01 10:30:22",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000020,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1410",NULL,NULL,"RESP_SAP","2025-03-02 09:10:34",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000021,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1411",NULL,NULL,"RESP_API","2025-04-01 13:25:58",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000022,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1412",NULL,NULL,"RESP_SAP","2025-04-02 08:40:12",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000023,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1413",NULL,NULL,"RESP_API","2025-05-01 08:15:23",NULL,"failed","{\"success\":false,\"status\":400,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000024,\"status\":0,\"message\":\"Invalid Data\"}]}",NULL),
("1414",NULL,NULL,"RESP_SAP","2025-05-02 12:30:45",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000025,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1415",NULL,NULL,"RESP_API","2025-06-01 09:45:12",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000026,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1416",NULL,NULL,"RESP_SAP","2025-06-02 14:20:33",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000027,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1417",NULL,NULL,"RESP_API","2025-07-01 11:10:57",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000028,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1418",NULL,NULL,"RESP_SAP","2025-07-02 16:25:19",NULL,"success","{\"success\":true,\"status\":200,\"data\":[{\"type\":\"S\",\"no_dokumen\":3100000029,\"status\":2,\"message\":\"Update Success\"}]}",NULL),
("1419",NULL,NULL,"RESP_API","2025-07-03 10:05:44",NULL,"failed","{\"success\":false,\"status\":500,\"data\":[{\"type\":\"E\",\"no_dokumen\":3100000030,\"status\":0,\"message\":\"Server Error\"}]}",NULL);
