<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity()]
#[ORM\Table(name: '`product`')]

class SaleProduct extends Product
{
    public function getName(): ?string
    {
        return $this->name . '  sale';
    }
    public function getPrice():  ?int
    {
        return $this->price - 40 ;
    }

}
