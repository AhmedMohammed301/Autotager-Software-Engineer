<?php

namespace App\Entity\Products;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: '`product`')]

class NormalProduct extends Product
{
    public function getName(): ?string
    {
        return $this->name . '  Normal';
    }
}
