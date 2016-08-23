<?php
namespace App\API\V1\Entities;

interface DeletableInterface
{
    public function delete();

    public function isDeleted();
}