<?php declare(strict_types=1);

namespace App\Administration\Domain\ValueObject;

use App\Administration\Domain\ValueObject\Enum\GamePeriodStrength;

final class ChampionGamePeriodStrengths
{
    /** @var bool */
    private $isStrongEarlygame = false;
    /** @var bool */
    private $isStrongMidgame = false;
    /** @var bool */
    private $isStrongLategame = false;

    public function __construct(GamePeriodStrength ...$gamePeriodStrengths)
    {
        array_walk($gamePeriodStrengths, function (GamePeriodStrength $gamePeriodStrength) {
            $this->{'is'.ucfirst($gamePeriodStrength->getValue())} = true;
        });
    }

    public function isStrongEarlygame(): bool
    {
        return $this->isStrongEarlygame;
    }

    public function isStrongMidgame(): bool
    {
        return $this->isStrongMidgame;
    }

    public function isStrongLategame(): bool
    {
        return $this->isStrongLategame;
    }
}
