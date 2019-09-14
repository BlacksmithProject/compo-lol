<?php declare(strict_types=1);

namespace App\Domain\Administration\Event;

use App\Domain\Administration\ValueObject\ChampionId;
use App\Domain\Administration\ValueObject\ChampionImageUrl;
use App\Domain\Administration\ValueObject\ChampionName;
use App\Domain\Administration\ValueObject\VersionNumber;

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
