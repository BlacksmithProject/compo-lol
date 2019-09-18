<?php declare(strict_types=1);

namespace App\Administration\Domain\ValueObject;

use App\Administration\Domain\ValueObject\Enum\ChampionAbility;

final class ChampionAbilities
{
    /** @var bool */
    private $hasHardEngage = false;
    /** @var bool */
    private $hasHardCrowdControl = false;
    /** @var bool */
    private $hasWaveClear = false;
    /** @var bool */
    private $hasDisengage = false;
    /** @var bool */
    private $hasPoke = false;

    public function __construct(ChampionAbility ...$championAbilities)
    {
        array_walk($championAbilities, function (ChampionAbility $championAbility) {
            $this->{'has'.ucfirst($championAbility->getValue())} = true;
        });
    }

    public function hasHardEngage(): bool
    {
        return $this->hasHardEngage;
    }

    public function hasHardCrowdControl(): bool
    {
        return $this->hasHardCrowdControl;
    }

    public function hasWaveClear(): bool
    {
        return $this->hasWaveClear;
    }

    public function hasDisengage(): bool
    {
        return $this->hasDisengage;
    }

    public function hasPoke(): bool
    {
        return $this->hasPoke;
    }
}
