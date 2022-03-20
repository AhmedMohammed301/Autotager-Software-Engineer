<?php

namespace App\Factory;

use App\Entity\Products\NormalProduct;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<NormalProduct>
 *
 * @method static NormalProduct|Proxy createOne(array $attributes = [])
 * @method static NormalProduct[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static NormalProduct|Proxy find(object|array|mixed $criteria)
 * @method static NormalProduct|Proxy findOrCreate(array $attributes)
 * @method static NormalProduct|Proxy first(string $sortedField = 'id')
 * @method static NormalProduct|Proxy last(string $sortedField = 'id')
 * @method static NormalProduct|Proxy random(array $attributes = [])
 * @method static NormalProduct|Proxy randomOrCreate(array $attributes = [])
 * @method static NormalProduct[]|Proxy[] all()
 * @method static NormalProduct[]|Proxy[] findBy(array $attributes)
 * @method static NormalProduct[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static NormalProduct[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method NormalProduct|Proxy create(array|callable $attributes = [])
 */
final class NormalProductFactory extends ModelFactory
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
            'name' => self::faker()->name(),
            'price' => self::faker()->randomNumber(),
            'amount' => self::faker()->randomNumber()+10,
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(NormalProduct $normalProduct): void {})
        ;
    }

    protected static function getClass(): string
    {
        return NormalProduct::class;
    }
}
