<?php declare(strict_types=1);

namespace App\Administration\Domain\ValueObject;

use BSP\CommandBus\Contracts\AggregateId;
use Ramsey\Uuid\UuidInterface;

final class ChampionIdentity implements AggregateId
{
    /** @var UuidInterface */
    private $uuid;

    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public function __toString()
    {
        return $this->uuid->toString();
    }
}
