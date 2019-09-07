<?php declare(strict_types=1);

namespace App\Domain\Administration\Actions\RegisterChampion;

use App\Domain\Administration\ValueObject\ChampionAbilities;
use App\Domain\Administration\ValueObject\ChampionIdentity;
use App\Domain\Administration\ValueObject\ChampionRoles;
use App\Domain\Administration\ValueObject\ChampionDamageTypes;
use App\Domain\Administration\ValueObject\ChampionGamePeriodStrengths;

final class RegisterChampionCommand
{
    /** @var ChampionIdentity */
    private $championIdentity;
    /** @var ChampionRoles */
    private $championRoles;
    /** @var ChampionAbilities */
    private $championAbilities;
    /** @var ChampionDamageTypes */
    private $damageType;
    /** @var ChampionGamePeriodStrengths */
    private $gamePeriodStrength;

    public function __construct(
        ChampionIdentity $championIdentity,
        ChampionRoles $championRoles,
        ChampionAbilities $championAbilities,
        ChampionDamageTypes $damageType,
        ChampionGamePeriodStrengths $gamePeriodStrength
    ) {
        $this->championIdentity = $championIdentity;
        $this->championRoles = $championRoles;
        $this->championAbilities = $championAbilities;
        $this->damageType = $damageType;
        $this->gamePeriodStrength = $gamePeriodStrength;
    }

    public function championIdentity(): ChampionIdentity
    {
        return $this->championIdentity;
    }

    public function championRoles(): ChampionRoles
    {
        return $this->championRoles;
    }

    public function championAbilities(): ChampionAbilities
    {
        return $this->championAbilities;
    }

    public function damageType(): ChampionDamageTypes
    {
        return $this->damageType;
    }

    public function gamePeriodStrength(): ChampionGamePeriodStrengths
    {
        return $this->gamePeriodStrength;
    }
}
