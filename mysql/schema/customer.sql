DROP TABLE IF EXISTS `customer`;

CREATE TABLE IF NOT EXISTS `customer` (
    `id` int(11) NOT NULL auto_increment,
    `company_name` varchar(250) NOT NULL,
    `first_name` varchar(250) NOT NULL,
    `last_name` varchar(250) NULL,
    `date_created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `date_updated` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);
