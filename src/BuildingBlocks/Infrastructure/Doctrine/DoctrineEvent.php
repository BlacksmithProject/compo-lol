<?php declare(strict_types=1);

namespace App\BuildingBlocks\Infrastructure\Doctrine;

use App\BuildingBlocks\Domain\Event;
use BSP\CommandBus\Contracts\AggregateId;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use function get_class;

/**
 * @ORM\Entity
 * @ORM\Table(name="events")
 */
final class DoctrineEvent
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $uuid;
    /**
     * @var AggregateId
     *
     * @ORM\Column(type="uuid")
     */
    private $aggregateId;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $type;
    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(type="json")
     */
    private $payload;

    public function __construct(
        UuidInterface $uuid,
        Event $event
    ) {
        $this->uuid = $uuid;
        $this->aggregateId = $event->aggregateId();
        $this->type = get_class($event);
        $this->createdAt = new DateTimeImmutable('now');

        $payload = json_encode($event->toArray());
        if (false === $payload) {
            throw new \RuntimeException();
        }

        $this->payload = $payload;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function aggregateId(): AggregateId
    {
        return $this->aggregateId;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function payload(): string
    {
        return $this->payload;
    }
}
