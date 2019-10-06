<?php declare(strict_types=1);

namespace App\Administration\Domain\Event;

use App\Administration\Domain\ValueObject\ChampionId;
use App\Administration\Domain\ValueObject\ChampionIdentity;
use App\Administration\Domain\ValueObject\ChampionImageUrl;
use App\Administration\Domain\ValueObject\ChampionName;
use App\Administration\Domain\ValueObject\VersionNumber;
use App\BuildingBlocks\Domain\CannotRebuildEventFromData;
use App\BuildingBlocks\Domain\Event;
use BSP\CommandBus\Contracts\AggregateId;
use Ramsey\Uuid\Uuid;

final class ChampionRegistered implements Event
{
    /** @var AggregateId */
    private $aggregateId;
    /** @var ChampionId */
    private $championId;
    /** @var VersionNumber */
    private $versionNumber;
    /** @var ChampionName */
    private $championName;
    /** @var ChampionImageUrl */
    private $championImageUrl;

    public function __construct(
        AggregateId $aggregateId,
        ChampionId $championId,
        VersionNumber $versionNumber,
        ChampionName $championName,
        ChampionImageUrl $championImageUrl
    ) {
        $this->aggregateId = $aggregateId;
        $this->championId = $championId;
        $this->versionNumber = $versionNumber;
        $this->championName = $championName;
        $this->championImageUrl = $championImageUrl;
    }

    public function aggregateId(): AggregateId
    {
        return $this->aggregateId;
    }

    public function championId(): ChampionId
    {
        return $this->championId;
    }

    public function versionNumber(): VersionNumber
    {
        return $this->versionNumber;
    }

    public function championName(): ChampionName
    {
        return $this->championName;
    }

    public function championImageUrl(): ChampionImageUrl
    {
        return $this->championImageUrl;
    }

    public function toArray(): array
    {
        return [
            'championIdentity' => $this->aggregateId->__toString(),
            'championId' => $this->championId->__toString(),
            'versionNumber' => $this->versionNumber->__toString(),
            'championName' => $this->championName->__toString(),
            'championImageUrl' => $this->championImageUrl->__toString(),
        ];
    }

    public static function fromArray(array $eventData): Event
    {
        if (
            false === isset($eventData['championIdentity'])
            || false === isset($eventData['championId'])
            || false === isset($eventData['versionNumber'])
            || false === isset($eventData['championName'])
            || false === isset($eventData['championImageUrl'])
        ) {
            throw new CannotRebuildEventFromData(static::class);
        }

        return new self(
            new ChampionIdentity(Uuid::fromString($eventData['championIdentity'])),
            new ChampionId($eventData['championId']),
            new VersionNumber($eventData['versionNumber']),
            new ChampionName($eventData['championName']),
            new ChampionImageUrl($eventData['championImageUrl'])
        );
    }
}
