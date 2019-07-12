DROP TABLE IF EXISTS `invoice`;

CREATE TABLE IF NOT EXISTS `invoice` (
    `id` INT (11) NOT NULL auto_increment,
    `reference` VARCHAR (250) NOT NULL,
    `total` DECIMAL,
    `vat` DECIMAL,
    `status_id` INT(11),
    `customer_id` INT(11) NULL,
    `date_created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `date_updated` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY fk_status(status_id)
        REFERENCES status(id),
    FOREIGN KEY fk_customer(customer_id)
        REFERENCES customer(id),
    PRIMARY KEY (id)
);
