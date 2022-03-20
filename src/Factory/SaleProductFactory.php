<?php

namespace App\Factory;

use App\Entity\Products\SaleProduct;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<SaleProduct>
 *
 * @method static SaleProduct|Proxy createOne(array $attributes = [])
 * @method static SaleProduct[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static SaleProduct|Proxy find(object|array|mixed $criteria)
 * @method static SaleProduct|Proxy findOrCreate(array $attributes)
 * @method static SaleProduct|Proxy first(string $sortedField = 'id')
 * @method static SaleProduct|Proxy last(string $sortedField = 'id')
 * @method static SaleProduct|Proxy random(array $attributes = [])
 * @method static SaleProduct|Proxy randomOrCreate(array $attributes = [])
 * @method static SaleProduct[]|Proxy[] all()
 * @method static SaleProduct[]|Proxy[] findBy(array $attributes)
 * @method static SaleProduct[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static SaleProduct[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method SaleProduct|Proxy create(array|callable $attributes = [])
 */
final class SaleProductFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [

            'name' => self::faker()->name(),
            'price' => self::faker()->randomNumber(),
            'amount' => self::faker()->randomNumber()+10,
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(SaleProduct $saleProduct): void {})
        ;
    }

    protected static function getClass(): string
    {
        return SaleProduct::class;
    }
}
