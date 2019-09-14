<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\Actions\RegisterChampion;

use App\Domain\Administration\Action\RegisterChampion\RegisterChampionCommand;
use App\Domain\Administration\Action\RegisterChampion\RegisterChampionCommandHandler;
use App\Domain\Administration\Exception\ChampionIdentityAlreadyUsed;
use App\Domain\Administration\Repository\ChampionRepository;
use App\Domain\Administration\ValueObject\ChampionId;
use App\Domain\Administration\ValueObject\ChampionImageUrl;
use App\Domain\Administration\ValueObject\ChampionName;
use App\Domain\Administration\ValueObject\VersionNumber;
use PHPUnit\Framework\TestCase;

final class RegisterChampionCommandHandlerTest extends TestCase
{
    public function test that champion cannot be registered if its id is already used(): void
    {
        $championRepository = $this->createMock(ChampionRepository::class);

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
        $championRepository = $this->createMock(ChampionRepository::class);

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
