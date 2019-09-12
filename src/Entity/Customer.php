<?php
namespace App\Entity;


class Customer extends AbstractEntity implements GenericEntityInterface
{
    /**
     * @var string
     */
    private $companyName = '';

    /**
     * @var string
     */
    private $firstName = '';

    /**
     * @var string
     */
    private $lastName = '';

    /**
     * @return string
     */
    public function __toString(): string
    {
        $names = [];
        if(false === empty($this->firstName)) {
            $names[] = $this->firstName;
        }

        if(false === empty($this->lastName)) {
            $names[] = $this->lastName;
        }

        return implode(' ', $names);
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $companyName
     * @return Customer
     */
    public function setCompanyName(string $companyName): Customer
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @param string $firstName
     * @return Customer
     */
    public function setFirstName(string $firstName): Customer
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param string $lastName
     * @return Customer
     */
    public function setLastName(string $lastName): Customer
    {
        $this->lastName = $lastName;
        return $this;
    }


}