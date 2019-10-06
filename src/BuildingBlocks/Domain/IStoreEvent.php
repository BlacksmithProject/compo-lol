<?php declare(strict_types=1);

namespace App\BuildingBlocks\Domain;

use BSP\CommandBus\Contracts\AggregateId;

interface IStoreEvent
{
    public function add(Event $event): void;

    public function findHistoryFor(AggregateId $id): History;
}
