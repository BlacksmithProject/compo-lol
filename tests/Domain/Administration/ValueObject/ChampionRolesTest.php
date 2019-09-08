<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\ValueObject;

use App\Domain\Administration\ValueObject\ChampionRoles;
use App\Domain\Administration\ValueObject\Enum\ChampionRole;
use PHPUnit\Framework\TestCase;

final class ChampionRolesTest extends TestCase
{
    public function test that champion roles are set with provided ones(): void
    {
        $championRoles = new ChampionRoles(ChampionRole::MARKSMAN());

        $this->assertTrue($championRoles->isMarksman());
        $this->assertFalse($championRoles->isTank());
        $this->assertFalse($championRoles->isSupport());
        $this->assertFalse($championRoles->isMage());
        $this->assertFalse($championRoles->isFighter());
        $this->assertFalse($championRoles->isAssassin());
    }
}
