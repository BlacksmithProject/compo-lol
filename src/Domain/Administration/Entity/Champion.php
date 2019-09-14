<?php declare(strict_types=1);

namespace App\Domain\Administration\Entity;

use App\Domain\Administration\Event\ChampionRegistered;
use App\Domain\Administration\ValueObject\ChampionAbilities;
use App\Domain\Administration\ValueObject\ChampionId;
use App\Domain\Administration\ValueObject\ChampionImageUrl;
use App\Domain\Administration\ValueObject\ChampionName;
use App\Domain\Administration\ValueObject\ChampionRoles;
use App\Domain\Administration\ValueObject\ChampionDamageTypes;
use App\Domain\Administration\ValueObject\ChampionGamePeriodStrengths;
use App\Domain\Administration\ValueObject\VersionNumber;
use BSP\EventManager\EventRegistration;
use BSP\EventManager\IRegisterEvents;

final class Champion implements IRegisterEvents
{
    use EventRegistration;

    /** @var ChampionRoles */
    private $roles;
    /** @var ChampionAbilities */
    private $abilities;
    /** @var ChampionDamageTypes */
    private $damageType;
    /** @var ChampionGamePeriodStrengths */
    private $gamePeriodStrength;
    /** @var ChampionId */
    private $championId;
    /** @var VersionNumber */
    private $versionNumber;
    /** @var ChampionName */
    private $championName;
    /** @var ChampionImageUrl */
    private $championImageUrl;

    private function __construct(
        ChampionId $championId,
        VersionNumber $versionNumber,
        ChampionName $championName,
        ChampionImageUrl $championImageUrl,
        ChampionRoles $championRoles,
        ChampionAbilities $championAbilities,
        ChampionDamageTypes $damageType,
        ChampionGamePeriodStrengths $gamePeriodStrength
    ) {
        $this->championId = $championId;
        $this->versionNumber = $versionNumber;
        $this->championName = $championName;
        $this->championImageUrl = $championImageUrl;
        $this->roles = $championRoles;
        $this->abilities = $championAbilities;
        $this->damageType = $damageType;
        $this->gamePeriodStrength = $gamePeriodStrength;
    }

    public static function register(
        ChampionId $championId,
        VersionNumber $versionNumber,
        ChampionName $championName,
        ChampionImageUrl $championImageUrl
    ): self {
        $champion = new self(
            $championId,
            $versionNumber,
            $championName,
            $championImageUrl,
            new ChampionRoles(),
            new ChampionAbilities(),
            new ChampionDamageTypes(),
            new ChampionGamePeriodStrengths()
        );

        $champion->recordedEvents[] = new ChampionRegistered(
            $championId,
            $versionNumber,
            $championName,
            $championImageUrl
        );

        return $champion;
    }
}
