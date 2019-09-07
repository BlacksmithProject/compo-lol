<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\Actions\RegisterChampion;

use App\Domain\Administration\Actions\RegisterChampion\RegisterChampionCommand;
use App\Domain\Administration\Actions\RegisterChampion\RegisterChampionCommandHandler;
use App\Domain\Administration\Exception\ChampionIdentityAlreadyUsed;
use App\Domain\Administration\Repository\ChampionRepository;
use App\Domain\Administration\ValueObject\ChampionAbilities;
use App\Domain\Administration\ValueObject\ChampionDamageTypes;
use App\Domain\Administration\ValueObject\ChampionGamePeriodStrengths;
use App\Domain\Administration\ValueObject\ChampionId;
use App\Domain\Administration\ValueObject\ChampionIdentity;
use App\Domain\Administration\ValueObject\ChampionRoles;
use App\Domain\Administration\ValueObject\Enum\ChampionAbility;
use App\Domain\Administration\ValueObject\Enum\ChampionRole;
use App\Domain\Administration\ValueObject\Enum\DamageType;
use App\Domain\Administration\ValueObject\Enum\GamePeriodStrength;
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
            new ChampionIdentity(
                new ChampionId('fake-id'),
                new VersionNumber('0.0.0'),
                'Fakename',
                'fake-image-url'
            ),
            new ChampionRoles(
                ChampionRole::TANK(),
                ChampionRole::SUPPORT()
            ),
            new ChampionAbilities(
                ChampionAbility::HARD_ENGAGE(),
                ChampionAbility::HARD_CC()
            ),
            new ChampionDamageTypes(DamageType::PHYSICAL()),
            new ChampionGamePeriodStrengths(
                GamePeriodStrength::EARLY_GAME(),
                GamePeriodStrength::LATE_GAME()
            )
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
            new ChampionIdentity(
                new ChampionId('fake-id'),
                new VersionNumber('0.0.0'),
                'Fakename',
                'fake-image-url'
            ),
            new ChampionRoles(
                ChampionRole::TANK(),
                ChampionRole::SUPPORT()
            ),
            new ChampionAbilities(
                ChampionAbility::HARD_ENGAGE(),
                ChampionAbility::HARD_CC()
            ),
            new ChampionDamageTypes(DamageType::PHYSICAL()),
            new ChampionGamePeriodStrengths(
                GamePeriodStrength::EARLY_GAME(),
                GamePeriodStrength::LATE_GAME()
            )
        );

        $handler = new RegisterChampionCommandHandler($championRepository);

        ($handler)($command);
    }
}
