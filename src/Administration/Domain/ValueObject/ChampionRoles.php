<?php declare(strict_types=1);

namespace App\Administration\Domain\ValueObject;

use App\Administration\Domain\ValueObject\Enum\ChampionRole;

final class ChampionRoles
{
    private $isAssassin = false;

    private $isFighter = false;

    private $isMage = false;

    private $isMarksman = false;

    private $isSupport = false;

    private $isTank = false;

    public function __construct(ChampionRole ...$championRoles)
    {
        array_walk($championRoles, function (ChampionRole $championRole) {
            $this->{'is'.ucfirst($championRole->getValue())} = true;
        });
    }

    public function isAssassin(): bool
    {
        return $this->isAssassin;
    }

    public function isFighter(): bool
    {
        return $this->isFighter;
    }

    public function isMage(): bool
    {
        return $this->isMage;
    }

    public function isMarksman(): bool
    {
        return $this->isMarksman;
    }

    public function isSupport(): bool
    {
        return $this->isSupport;
    }

    public function isTank(): bool
    {
        return $this->isTank;
    }
}
