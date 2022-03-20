<?php

namespace App\Entity\Carts;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: '`cart`')]

class OrderCart extends Cart
{

}
