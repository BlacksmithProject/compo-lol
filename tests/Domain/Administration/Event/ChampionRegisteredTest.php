<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\Event;

use App\Domain\Administration\Event\ChampionRegistered;
use App\Domain\Administration\ValueObject\ChampionId;
use PHPUnit\Framework\TestCase;

final class ChampionRegisteredTest extends TestCase
{
    public function test it can be initialized(): void
    {
        $championId = new ChampionId('Fakename');

        $event = new ChampionRegistered($championId);

        $this->assertSame($championId, $event->championId());
    }
}
