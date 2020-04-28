<?php

namespace App\DB\Builder;

interface CollectionInterface
{
    public function set(array $data = []): CollectionInterface;
    public function getSQL(): string;
}