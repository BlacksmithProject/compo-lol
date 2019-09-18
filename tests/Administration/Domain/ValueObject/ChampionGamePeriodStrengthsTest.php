<?php declare(strict_types=1);

namespace App\Tests\Administration\Domain\ValueObject;

use App\Administration\Domain\ValueObject\ChampionGamePeriodStrengths;
use App\Administration\Domain\ValueObject\Enum\GamePeriodStrength;
use PHPUnit\Framework\TestCase;

final class ChampionGamePeriodStrengthsTest extends TestCase
{
    public function test that champion game period strengths are set with provided ones(): void
    {
        $championGamePeriodStrengths = new ChampionGamePeriodStrengths(
            GamePeriodStrength::EARLY_GAME(),
            GamePeriodStrength::MID_GAME()
        );

        $this->assertTrue($championGamePeriodStrengths->isStrongEarlygame());
        $this->assertTrue($championGamePeriodStrengths->isStrongMidgame());
        $this->assertFalse($championGamePeriodStrengths->isStrongLategame());
    }
}
