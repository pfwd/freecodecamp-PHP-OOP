<?php

namespace App\Hydration;

use App\Entity\Customer;

class CustomerHydrator extends AbstractHydrator
{
    public static function hydrate(array $data): Customer
    {
        $entity = new Customer();
        $entity->setCompanyName($data['company_name'])
            ->setFirstName($data['first_name'])
            ->setLastName($data['last_name'])
        ;
        parent::hydrateRest($data, $entity);

        return $entity;

    }

}