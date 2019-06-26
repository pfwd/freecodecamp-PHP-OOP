<?php
namespace App\Helper\HTTP\Request;

interface RequestAdaptorInterface
{
    public function setPath(string $path);
    public function setMethod(string $path);
}