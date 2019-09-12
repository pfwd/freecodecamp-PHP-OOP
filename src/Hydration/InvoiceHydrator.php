<?php

namespace App\Hydration;

use App\Entity\Invoice;

class InvoiceHydrator extends AbstractHydrator
{
    public static function hydrate(array $data): Invoice
    {
        $entity = new Invoice();
        $entity->setReference($data['reference'])
            ->setTotal($data['total'])
            ->setVAT($data['vat'])
        ;
        parent::hydrateRest($data, $entity);

        return $entity;

    }

}