<?php declare(strict_types=1);

namespace App\Administration\Domain\Repository;

use App\Administration\Domain\Entity\Champion;
use App\Administration\Domain\ValueObject\ChampionId;

interface IWriteChampions
{
    public function isIdAlreadyUsed(ChampionId $championId): bool;

    public function add(Champion $champion): void;
}
