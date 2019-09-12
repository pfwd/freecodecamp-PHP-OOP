<?php

namespace App\Hydration;

use App\Entity\GenericEntityInterface;
use DateTime;

abstract class AbstractHydrator
{
    public static function hydrateRest(array $data, GenericEntityInterface $entity)
    {
        $dateCreated = new DateTime($data['date_created']);
        $dateUpdate = new DateTime($data['date_updated']);

        $entity->setDateCreated($dateCreated);
        $entity->setDateUpdated($dateUpdate);
        $entity->setId($data['id']);
        return $entity;

    }

}