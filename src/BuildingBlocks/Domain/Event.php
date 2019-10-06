<?php declare(strict_types=1);

namespace App\BuildingBlocks\Domain;

use BSP\CommandBus\Contracts\AggregateId;

interface Event
{
    public function aggregateId(): AggregateId;

    public function toArray(): array;

    /**
     * @throws CannotRebuildEventFromData
     */
    public static function fromArray(array $eventData): self;
}
