<?php declare(strict_types=1);

namespace App\Tests\Administration\Domain\Actions\RegisterChampion;

use App\Administration\Domain\Action\RegisterChampion\RegisterChampionCommand;
use App\Administration\Domain\Action\RegisterChampion\RegisterChampionCommandHandler;
use App\Administration\Domain\Event\ChampionRegistered;
use App\Administration\Domain\Exception\ChampionIdentityAlreadyUsed;
use App\Administration\Domain\ValueObject\ChampionId;
use App\Administration\Domain\ValueObject\ChampionIdentity;
use App\Administration\Domain\ValueObject\ChampionImageUrl;
use App\Administration\Domain\ValueObject\ChampionName;
use App\Administration\Domain\ValueObject\VersionNumber;
use App\BuildingBlocks\Domain\Event;
use App\BuildingBlocks\Domain\History;
use App\BuildingBlocks\Domain\IStoreEvent;
use App\BuildingBlocks\Infrastructure\SimpleHistory;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class RegisterChampionCommandHandlerTest extends TestCase
{
    public function test that champion cannot be registered if its id is already used(): void
    {
        $eventStore = $this->createMock(IStoreEvent::class);

        $history = $this->createMock(History::class);
        $history->method('events')->willReturn([$this->createMock(Event::class)]);

        $eventStore
            ->expects($this->once())
            ->method('findHistoryFor')
            ->willReturn($history);

        $command = new RegisterChampionCommand(
            new ChampionIdentity(Uuid::uuid4()),
            new ChampionId('fake-id'),
            new VersionNumber('0.0.0'),
            new ChampionName('Fakename'),
            new ChampionImageUrl('fake-image-url')
        );

        $handler = new RegisterChampionCommandHandler($eventStore);

        $this->expectException(ChampionIdentityAlreadyUsed::class);
        ($handler)($command);
    }

    public function test that champion can be registered(): void
    {
        $eventStore = $this->createMock(IStoreEvent::class);

        $history = $this->createMock(History::class);
        $history->method('events')->willReturn([]);

        $eventStore
            ->expects($this->once())
            ->method('findHistoryFor')
            ->willReturn($history);

        $eventStore
            ->expects($this->once())
            ->method('add');

        $command = new RegisterChampionCommand(
            new ChampionIdentity(Uuid::uuid4()),
            new ChampionId('fake-id'),
            new VersionNumber('0.0.0'),
            new ChampionName('Fakename'),
            new ChampionImageUrl('fake-image-url')
        );

        $handler = new RegisterChampionCommandHandler($eventStore);

        ($handler)($command);
    }
}
