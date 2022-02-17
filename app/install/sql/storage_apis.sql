DROP TABLE IF EXISTS `%table_prefix%storage_apis`;
CREATE TABLE `%table_prefix%storage_apis` (
  `storage_api_id` bigint(32) NOT NULL AUTO_INCREMENT,
  `storage_api_name` varchar(255) NOT NULL,
  `storage_api_type` varchar(255) NOT NULL,
  PRIMARY KEY (`storage_api_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `%table_prefix%storage_apis` VALUES ('1', 'Amazon S3', 's3');
INSERT INTO `%table_prefix%storage_apis` VALUES ('2', 'Google Cloud', 'gcloud');
INSERT INTO `%table_prefix%storage_apis` VALUES ('3', 'Microsoft Azure', 'azure');
INSERT INTO `%table_prefix%storage_apis` VALUES ('4', 'Chevereto Grid', 'chvgrid');
INSERT INTO `%table_prefix%storage_apis` VALUES ('5', 'FTP', 'ftp');
INSERT INTO `%table_prefix%storage_apis` VALUES ('6', 'SFTP', 'sftp');
INSERT INTO `%table_prefix%storage_apis` VALUES ('7', 'OpenStack', 'openstack');
INSERT INTO `%table_prefix%storage_apis` VALUES ('8', 'Local', 'local');
INSERT INTO `%table_prefix%storage_apis` VALUES ('9', 'S3 compatible', 's3compatible');
INSERT INTO `%table_prefix%storage_apis` VALUES ('10', 'Alibaba Cloud OSS', 'oss');
INSERT INTO `%table_prefix%storage_apis` VALUES ('11', 'Backblaze B2', 'b2');