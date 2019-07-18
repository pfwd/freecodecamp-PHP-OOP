<?php
namespace App\Manager;

abstract class AbstractManager
{
    abstract public function findOne(int $id);
}