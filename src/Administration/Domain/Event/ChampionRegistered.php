<?php declare(strict_types=1);

namespace App\Administration\Domain\Event;

use App\Administration\Domain\ValueObject\ChampionId;
use App\Administration\Domain\ValueObject\ChampionImageUrl;
use App\Administration\Domain\ValueObject\ChampionName;
use App\Administration\Domain\ValueObject\VersionNumber;

final class ChampionRegistered
{
    /** @var ChampionId */
    private $championId;
    /** @var VersionNumber */
    private $versionNumber;
    /** @var ChampionName */
    private $championName;
    /** @var ChampionImageUrl */
    private $championImageUrl;

    public function __construct(
        ChampionId $championId,
        VersionNumber $versionNumber,
        ChampionName $championName,
        ChampionImageUrl $championImageUrl
    ) {
        $this->championId = $championId;
        $this->versionNumber = $versionNumber;
        $this->championName = $championName;
        $this->championImageUrl = $championImageUrl;
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
}
