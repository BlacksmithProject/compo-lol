<?php declare(strict_types=1);

namespace App\Domain\Administration\ValueObject;

use App\Domain\Administration\ValueObject\Enum\DamageType;

final class ChampionDamageTypes
{
    /** @var bool */
    private $isPhysical = false;
    /** @var bool */
    private $isMagical = false;

    public function __construct(DamageType ...$damageTypes)
    {
        array_walk($damageTypes, function (DamageType $damageType) {
            $this->{'is'.ucfirst($damageType->getValue())} = true;
        });
    }

    public function isPhysical(): bool
    {
        return $this->isPhysical;
    }

    public function isMagical(): bool
    {
        return $this->isMagical;
    }
}
