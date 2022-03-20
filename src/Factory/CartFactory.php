<?php

namespace App\Factory;

use Symfony\Component\Config\Definition\Exception\Exception;

class CartFactory
{
    public function getCartType($value) :string
    {
        $className = ucfirst($value);

        $class = 'App\\Entity\\Carts' . "\\{$className}".'Cart';
        if (!class_exists($class)) {
            throw new Exception('class not fount');
        }
        return $class;
    }

}