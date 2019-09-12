<?php
namespace App\Entity;

use DateTime;

interface GenericEntityInterface
{
    /**
     * @return int
     */
    public function getId():?int;

    /**
     * @param int $id
     */
    public function setId(?int $id);

    /**
     * @return DateTime
     */
    public function getDateCreated():?DateTime;

    /**
     * @param DateTime $dateCreated
     */
    public function setDateCreated(?DateTime $dateCreated);

    /**
     * @return DateTime
     */
    public function getDateUpdated():?DateTime;

    /**
     * @param DateTime $dateUpdated
     */
    public function setDateUpdated(?DateTime $dateUpdated);

}
