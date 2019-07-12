DROP TABLE IF EXISTS `invoice_item`;

CREATE TABLE IF NOT EXISTS `invoice_item` (
    `id` INT (11) NOT NULL auto_increment,
    `reference` VARCHAR (250) NULL,
    `description` VARCHAR (250) NOT NULL,
    `unit_price` DECIMAL NOT NULL,
    `units` INT(11) NOT NULL,
    `total` DECIMAL NOT NULL,
    `invoice_id` INT(11) NOT NULL,
    `date_created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `date_updated` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY fk_invoice(invoice_id)
        REFERENCES invoice(id),
    PRIMARY KEY (id)
);
