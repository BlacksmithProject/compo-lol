<?php declare(strict_types=1);

namespace App\Administration\Domain\Action\RegisterChampion;

use App\Administration\Domain\Entity\Champion;
use App\Administration\Domain\Exception\ChampionIdentityAlreadyUsed;
use App\BuildingBlocks\Domain\IStoreEvent;

final class RegisterChampionCommandHandler
{
    private $eventStore;

    public function __construct(IStoreEvent $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    /**
     * @throws ChampionIdentityAlreadyUsed
     */
    public function __invoke(RegisterChampionCommand $command): void
    {
        $history = $this->eventStore->findHistoryFor($command->aggregateId());
        if ($history->events() !== []) {
            throw new ChampionIdentityAlreadyUsed();
        }

        $champion = Champion::register(
            $command->aggregateId(),
            $command->championId(),
            $command->versionNumber(),
            $command->championName(),
            $command->championImageUrl()
        );

        foreach ($champion->registeredEvents() as $event) {
            $this->eventStore->add($event);
        }

        $champion->clearRegisteredEvents();
    }
}
