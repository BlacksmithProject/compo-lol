<?php declare(strict_types=1);

namespace App\Tests\Administration\Domain\ValueObject;

use App\Administration\Domain\ValueObject\ChampionAbilities;
use App\Administration\Domain\ValueObject\Enum\ChampionAbility;
use PHPUnit\Framework\TestCase;

final class ChampionAbilitiesTest extends TestCase
{
    public function test that champion abilities are set with provided ones(): void
    {
        $championAbilities = new ChampionAbilities(
            ChampionAbility::POKE(),
            ChampionAbility::WAVE_CLEAR()
        );

        $this->assertTrue($championAbilities->hasPoke());
        $this->assertTrue($championAbilities->hasWaveClear());
        $this->assertFalse($championAbilities->hasDisengage());
        $this->assertFalse($championAbilities->hasHardEngage());
        $this->assertFalse($championAbilities->hasHardCrowdControl());
    }
}
