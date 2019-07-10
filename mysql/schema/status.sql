DROP TABLE IF EXISTS `status`;

CREATE TABLE IF NOT EXISTS `status` (
    `id` int(11) NOT NULL auto_increment,
    `name` varchar(250) NOT NULL,
    `internal_name` varchar(250) NOT NULL,
    `date_created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `date_updated` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);
