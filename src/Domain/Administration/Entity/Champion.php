<?php declare(strict_types=1);

namespace App\Domain\Administration\Entity;

use App\Domain\Administration\Event\ChampionRegistered;
use App\Domain\Administration\ValueObject\ChampionAbilities;
use App\Domain\Administration\ValueObject\ChampionIdentity;
use App\Domain\Administration\ValueObject\ChampionRoles;
use App\Domain\Administration\ValueObject\ChampionDamageTypes;
use App\Domain\Administration\ValueObject\ChampionGamePeriodStrengths;
use BSP\EventManager\EventRegistration;
use BSP\EventManager\IRegisterEvents;

final class Champion implements IRegisterEvents
{
    use EventRegistration;

    /** @var ChampionIdentity */
    private $identity;
    /** @var ChampionRoles */
    private $roles;
    /** @var ChampionAbilities */
    private $abilities;
    /** @var ChampionDamageTypes */
    private $damageType;
    /** @var ChampionGamePeriodStrengths */
    private $gamePeriodStrength;

    private function __construct(
        ChampionIdentity $championIdentity,
        ChampionRoles $championRoles,
        ChampionAbilities $championAbilities,
        ChampionDamageTypes $damageType,
        ChampionGamePeriodStrengths $gamePeriodStrength
    ) {
        $this->identity = $championIdentity;
        $this->roles = $championRoles;
        $this->abilities = $championAbilities;
        $this->damageType = $damageType;
        $this->gamePeriodStrength = $gamePeriodStrength;
    }

    public static function register(
        ChampionIdentity $championIdentity,
        ChampionRoles $championRoles,
        ChampionAbilities $championAbilities,
        ChampionDamageTypes $damageType,
        ChampionGamePeriodStrengths $gamePeriodStrength
    ): self {
        $champion = new self(
            $championIdentity,
            $championRoles,
            $championAbilities,
            $damageType,
            $gamePeriodStrength
        );

        $champion->recordedEvents[] = new ChampionRegistered($championIdentity->id());

        return $champion;
    }
}
