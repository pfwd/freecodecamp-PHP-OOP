<?php

namespace App\Hydration;

use App\Entity\Status;

class StatusHydrator extends AbstractHydrator
{
    public static function hydrate(array $data): Status
    {
        $entity = new Status();
        $entity->setName($data['name'])
            ->setInternalName($data['internal_name'])
        ;
        parent::hydrateRest($data, $entity);

        return $entity;

    }

}