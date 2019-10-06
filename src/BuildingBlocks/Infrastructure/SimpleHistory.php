<?php declare(strict_types=1);

namespace App\BuildingBlocks\Infrastructure;

use App\BuildingBlocks\Domain\Event;
use App\BuildingBlocks\Domain\History;
use BSP\CommandBus\Contracts\AggregateId;

final class SimpleHistory implements History
{
    /** @var AggregateId */
    private $aggregateId;
    /** @var Event[] */
    private $events = [];

    public function __construct(AggregateId $aggregateId)
    {
        $this->aggregateId = $aggregateId;
    }

    public function addEvent(Event $event): void
    {
        $this->events[] = $event;
    }

    public function aggregateId(): AggregateId
    {
        return $this->aggregateId;
    }

    /** @return Event[] */
    public function events(): array
    {
        return $this->events;
    }
}
