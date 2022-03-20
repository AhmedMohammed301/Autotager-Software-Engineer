<?php
namespace App\Factories;

use Symfony\Component\Config\Definition\Exception\Exception;

class ProductFactory
{
    public function getProductType($value) :string
    {
        $className = ucfirst($value);

        $class = 'App\\Entity\\Products' . "\\{$className}".'Product';
        if (!class_exists($class)) {
            throw new Exception('class not fount');
        }
        return $class;
    }

}