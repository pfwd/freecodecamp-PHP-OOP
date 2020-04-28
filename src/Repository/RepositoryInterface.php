<?php

namespace App\Repository;

use stdClass;

interface RepositoryInterface
{
    public function findAll(): array;

    public function findOne(): stdClass;

}