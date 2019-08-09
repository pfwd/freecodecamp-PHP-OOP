<?php
namespace App\Entity;

use DateTime;

abstract class AbstractEntity
{
    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var null|DateTime
     */
    protected $dateCreated;

    /**
     * @var null|DateTime
     */
    protected $dateUpdated;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return AbstractEntity
     */
    public function setId(?int $id): AbstractEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateCreated(): ?DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param DateTime|null $dateCreated
     * @return AbstractEntity
     */
    public function setDateCreated(?DateTime $dateCreated): AbstractEntity
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateUpdated(): ?DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @param DateTime|null $dateUpdated
     * @return AbstractEntity
     */
    public function setDateUpdated(?DateTime $dateUpdated): AbstractEntity
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }


}