<?php

namespace App\Factory;

use App\Entity\Carts\OrderCart;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<OrderCart>
 *
 * @method static OrderCart|Proxy createOne(array $attributes = [])
 * @method static OrderCart[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static OrderCart|Proxy find(object|array|mixed $criteria)
 * @method static OrderCart|Proxy findOrCreate(array $attributes)
 * @method static OrderCart|Proxy first(string $sortedField = 'id')
 * @method static OrderCart|Proxy last(string $sortedField = 'id')
 * @method static OrderCart|Proxy random(array $attributes = [])
 * @method static OrderCart|Proxy randomOrCreate(array $attributes = [])
 * @method static OrderCart[]|Proxy[] all()
 * @method static OrderCart[]|Proxy[] findBy(array $attributes)
 * @method static OrderCart[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static OrderCart[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method OrderCart|Proxy create(array|callable $attributes = [])
 */
final class OrderCartFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();


    }

    protected function getDefaults(): array
    {
        return [
            'name' => 'order',

            'total_price' => self::faker()->randomNumber(),
            'total_amount' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(OrderCart $orderCart): void {})
        ;
    }

    protected static function getClass(): string
    {
        return OrderCart::class;
    }
}
