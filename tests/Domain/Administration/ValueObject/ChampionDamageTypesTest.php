<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\ValueObject;

use App\Domain\Administration\ValueObject\ChampionDamageTypes;
use App\Domain\Administration\ValueObject\Enum\DamageType;
use PHPUnit\Framework\TestCase;

final class ChampionDamageTypesTest extends TestCase
{
    public function test that champion damage types are set with provided ones(): void
    {
        $championDamageTypes = new ChampionDamageTypes(DamageType::PHYSICAL());

        $this->assertTrue($championDamageTypes->isPhysical());
        $this->assertFalse($championDamageTypes->isMagical());
    }
}
