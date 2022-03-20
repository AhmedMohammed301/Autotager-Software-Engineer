<?php

namespace App\Factory;

use App\Entity\Carts\WishListCart;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<WishListCart>
 *
 * @method static WishListCart|Proxy createOne(array $attributes = [])
 * @method static WishListCart[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static WishListCart|Proxy find(object|array|mixed $criteria)
 * @method static WishListCart|Proxy findOrCreate(array $attributes)
 * @method static WishListCart|Proxy first(string $sortedField = 'id')
 * @method static WishListCart|Proxy last(string $sortedField = 'id')
 * @method static WishListCart|Proxy random(array $attributes = [])
 * @method static WishListCart|Proxy randomOrCreate(array $attributes = [])
 * @method static WishListCart[]|Proxy[] all()
 * @method static WishListCart[]|Proxy[] findBy(array $attributes)
 * @method static WishListCart[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static WishListCart[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method WishListCart|Proxy create(array|callable $attributes = [])
 */
final class WishListCartFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'name' => 'wish-list',
            'user_id'=>1,
            'total_price' => self::faker()->randomNumber(),
            'total_amount' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(WishListCart $wishListCart): void {})
        ;
    }

    protected static function getClass(): string
    {
        return WishListCart::class;
    }
}
