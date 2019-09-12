<?php

namespace App\Hydration;

use App\Entity\InvoiceItem;

class InvoiceItemHydrator extends AbstractHydrator
{
    public static function hydrate(array $data): InvoiceItem
    {
        $entity = new InvoiceItem();
        $entity->setReference($data['reference'])
            ->setDescription($data['description'])
            ->setTotal($data['total'])
            ->setUnitPrice($data['unit_price'])
            ->setUnits($data['units'])
        ;
        parent::hydrateRest($data, $entity);

        return $entity;

    }

}