<?php

namespace App\Entity\Products;


use Doctrine\ORM\Mapping as ORM;

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
