<?php declare(strict_types=1);

namespace App\BuildingBlocks\Infrastructure\Doctrine;

use App\BuildingBlocks\Domain\CannotRebuildEventFromData;
use App\BuildingBlocks\Domain\Event;
use App\BuildingBlocks\Domain\History;
use App\BuildingBlocks\Domain\IStoreEvent;
use App\BuildingBlocks\Infrastructure\SimpleHistory;
use BSP\CommandBus\Contracts\AggregateId;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

final class DoctrineEventStore implements IStoreEvent
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Event $event): void
    {
        $doctrineEvent = new DoctrineEvent(Uuid::uuid4(), $event);

        $this->entityManager->persist($doctrineEvent);
        $this->entityManager->flush();
    }

    /**
     * @throws CannotRebuildEventFromData
     */
    public function findHistoryFor(AggregateId $id): History
    {
        $history = new SimpleHistory($id);

        /** @var DoctrineEvent[] $doctrineEvents */
        $doctrineEvents = $this->entityManager->createQueryBuilder()
            ->select('E')
            ->from(DoctrineEvent::class, 'E')
            ->where('E.aggregateId = :id')
            ->setParameter('id', $id->__toString())
            ->orderBy('E.createdAt', 'ASC')
            ->getQuery()
            ->getResult();

        foreach ($doctrineEvents as $doctrineEvent) {
            /** @var Event $eventClass */
            $eventClass = $doctrineEvent->type();
            $event = $eventClass::fromArray(json_decode($doctrineEvent->payload(), true));
            $history->addEvent($event);
        }

        return $history;
    }
}
