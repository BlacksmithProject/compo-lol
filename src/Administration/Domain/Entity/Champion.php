<?php declare(strict_types=1);

namespace App\Administration\Domain\Entity;

use App\Administration\Domain\Event\ChampionRegistered;
use App\Administration\Domain\ValueObject\ChampionAbilities;
use App\Administration\Domain\ValueObject\ChampionId;
use App\Administration\Domain\ValueObject\ChampionIdentity;
use App\Administration\Domain\ValueObject\ChampionImageUrl;
use App\Administration\Domain\ValueObject\ChampionName;
use App\Administration\Domain\ValueObject\ChampionRoles;
use App\Administration\Domain\ValueObject\ChampionDamageTypes;
use App\Administration\Domain\ValueObject\ChampionGamePeriodStrengths;
use App\Administration\Domain\ValueObject\VersionNumber;
use App\BuildingBlocks\Domain\Aggregate;
use App\BuildingBlocks\Domain\CannotApplyEventOnAggregate;
use App\BuildingBlocks\Domain\History;
use BSP\CommandBus\Contracts\AggregateId;
use BSP\EventManager\EventRegistration;
use BSP\EventManager\IRegisterEvents;

final class Champion implements IRegisterEvents, Aggregate
{
    use EventRegistration;

    /** @var AggregateId */
    private $identity;
    /** @var ChampionId */
    private $id;
    /** @var VersionNumber */
    private $versionNumber;
    /** @var ChampionName */
    private $name;
    /** @var ChampionImageUrl */
    private $imageUrl;
    /** @var ChampionRoles */
    private $roles;
    /** @var ChampionAbilities */
    private $abilities;
    /** @var ChampionDamageTypes */
    private $damageType;
    /** @var ChampionGamePeriodStrengths */
    private $gamePeriodStrength;

    private function __construct(AggregateId $championId)
    {
        $this->identity = $championId;
    }

    private static function createEmptyChampion(AggregateId $aggregateId): self
    {
        $champion = new self($aggregateId);

        $champion->roles = new ChampionRoles();
        $champion->abilities = new ChampionAbilities();
        $champion->damageType = new ChampionDamageTypes();
        $champion->gamePeriodStrength = new ChampionGamePeriodStrengths();

        return $champion;
    }

    public static function register(
        ChampionIdentity $championIdentity,
        ChampionId $championId,
        VersionNumber $versionNumber,
        ChampionName $championName,
        ChampionImageUrl $championImageUrl
    ): self {
        $champion = static::createEmptyChampion($championIdentity);

        $champion->id = $championId;
        $champion->versionNumber = $versionNumber;
        $champion->name = $championName;
        $champion->imageUrl = $championImageUrl;

        $champion->recordedEvents[] = new ChampionRegistered(
            $championIdentity,
            $championId,
            $versionNumber,
            $championName,
            $championImageUrl
        );

        return $champion;
    }

    public function id(): AggregateId
    {
        return $this->identity;
    }

    public function applyChampionRegistered(ChampionRegistered $championRegistered): void
    {
        $this->id = $championRegistered->championId();
        $this->versionNumber = $championRegistered->versionNumber();
        $this->name = $championRegistered->championName();
        $this->imageUrl = $championRegistered->championImageUrl();
    }

    /**
     * @throws CannotApplyEventOnAggregate
     */
    public static function fromHistory(History $history): self
    {
        $champion = static::createEmptyChampion($history->aggregateId());
        foreach ($history->events() as $event) {
            if ($event instanceof ChampionRegistered) {
                $champion->applyChampionRegistered($event);
            } else {
                throw new CannotApplyEventOnAggregate(get_class($event), static::class);
            }
        }

        return $champion;
    }
}
