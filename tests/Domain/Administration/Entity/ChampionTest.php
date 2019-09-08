<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\Entity;

use App\Domain\Administration\Entity\Champion;
use App\Domain\Administration\Event\ChampionRegistered;
use App\Domain\Administration\ValueObject\ChampionAbilities;
use App\Domain\Administration\ValueObject\ChampionId;
use App\Domain\Administration\ValueObject\ChampionIdentity;
use App\Domain\Administration\ValueObject\ChampionRoles;
use App\Domain\Administration\ValueObject\ChampionDamageTypes;
use App\Domain\Administration\ValueObject\ChampionGamePeriodStrengths;
use App\Domain\Administration\ValueObject\Enum\ChampionAbility;
use App\Domain\Administration\ValueObject\Enum\ChampionRole;
use App\Domain\Administration\ValueObject\Enum\DamageType;
use App\Domain\Administration\ValueObject\Enum\GamePeriodStrength;
use App\Domain\Administration\ValueObject\VersionNumber;
use PHPUnit\Framework\TestCase;

final class ChampionTest extends TestCase
{
    public function test champion has ChampionRegistered event on registration(): void
    {
        $champion = Champion::register(
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

        $registeredChampionRegisteredEvents = array_filter($champion->registeredEvents(), function ($event): bool {
            return $event instanceof ChampionRegistered;
        });

        $this->assertSame(1, \count($registeredChampionRegisteredEvents));
    }
}
