<?php declare(strict_types=1);

namespace App\Domain\Administration\Event;

use App\Domain\Administration\ValueObject\ChampionId;

final class ChampionRegistered
{
    /** @var ChampionId */
    private $championId;

    public function __construct(ChampionId $championId)
    {
        $this->championId = $championId;
    }

    public function championId(): ChampionId
    {
        return $this->championId;
    }
}
