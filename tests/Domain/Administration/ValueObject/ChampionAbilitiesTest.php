<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\ValueObject;

use App\Domain\Administration\ValueObject\ChampionAbilities;
use App\Domain\Administration\ValueObject\Enum\ChampionAbility;
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
