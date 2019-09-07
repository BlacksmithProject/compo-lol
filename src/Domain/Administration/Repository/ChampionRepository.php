<?php declare(strict_types=1);

namespace App\Domain\Administration\Repository;

use App\Domain\Administration\Entity\Champion;
use App\Domain\Administration\ValueObject\ChampionId;

interface ChampionRepository
{
    public function isIdAlreadyUsed(ChampionId $championId): bool;

    public function add(Champion $champion): void;
}
