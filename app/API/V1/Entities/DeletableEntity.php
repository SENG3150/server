<?php
namespace App\API\V1\Entities;

use App\Entities\Entity;
use Doctrine\ORM\Mapping AS ORM;

abstract class DeletableEntity extends Entity implements DeletableInterface
{
    /**
     * @ORM\Column(name="deleted", type="boolean")
     * @var bool $deleted
     */
    protected $deleted = FALSE;

    public function delete()
    {
        $this->deleted = true;
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }
}