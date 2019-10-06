<?php declare(strict_types=1);

namespace App\BuildingBlocks\Domain;

use BSP\CommandBus\Contracts\AggregateId;

interface Aggregate
{
    public function id(): AggregateId;

    /** @throws CannotApplyEventOnAggregate */
    public static function fromHistory(History $history);
}
