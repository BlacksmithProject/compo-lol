<?php declare(strict_types=1);

namespace App\Tests\Administration\Domain\Actions\RegisterChampion;

use App\Administration\Domain\Action\RegisterChampion\RegisterChampionCommand;
use App\Administration\Domain\Action\RegisterChampion\RegisterChampionCommandHandler;
use App\Administration\Domain\Exception\ChampionIdentityAlreadyUsed;
use App\Administration\Domain\Repository\IWriteChampions;
use App\Administration\Domain\ValueObject\ChampionId;
use App\Administration\Domain\ValueObject\ChampionImageUrl;
use App\Administration\Domain\ValueObject\ChampionName;
use App\Administration\Domain\ValueObject\VersionNumber;
use PHPUnit\Framework\TestCase;

final class RegisterChampionCommandHandlerTest extends TestCase
{
    public function test that champion cannot be registered if its id is already used(): void
    {
        $championRepository = $this->createMock(IWriteChampions::class);

        $championRepository
            ->expects($this->once())
            ->method('isIdAlreadyUsed')
            ->willReturn(true);

        $command = new RegisterChampionCommand(
            new ChampionId('fake-id'),
            new VersionNumber('0.0.0'),
            new ChampionName('Fakename'),
            new ChampionImageUrl('fake-image-url')
        );

        $handler = new RegisterChampionCommandHandler($championRepository);

        $this->expectException(ChampionIdentityAlreadyUsed::class);
        ($handler)($command);
    }

    public function test that champion can be registered(): void
    {
        $championRepository = $this->createMock(IWriteChampions::class);

        $championRepository
            ->expects($this->once())
            ->method('isIdAlreadyUsed')
            ->willReturn(false);

        $championRepository
            ->expects($this->once())
            ->method('add');

        $command = new RegisterChampionCommand(
            new ChampionId('fake-id'),
            new VersionNumber('0.0.0'),
            new ChampionName('Fakename'),
            new ChampionImageUrl('fake-image-url')
        );

        $handler = new RegisterChampionCommandHandler($championRepository);

        ($handler)($command);
    }
}
