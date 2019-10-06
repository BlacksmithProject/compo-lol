<?php declare(strict_types=1);

namespace App\BuildingBlocks\Domain;

use BSP\CommandBus\Contracts\AggregateId;

interface History
{
    public function aggregateId(): AggregateId;

    /** @return Event[] */
    public function events(): array;
}
