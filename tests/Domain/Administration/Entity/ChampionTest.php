<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\Entity;

use App\Domain\Administration\Entity\Champion;
use App\Domain\Administration\Event\ChampionRegistered;
use App\Domain\Administration\ValueObject\ChampionId;
use App\Domain\Administration\ValueObject\ChampionIdentity;
use App\Domain\Administration\ValueObject\ChampionImageUrl;
use App\Domain\Administration\ValueObject\ChampionName;
use App\Domain\Administration\ValueObject\VersionNumber;
use PHPUnit\Framework\TestCase;

final class ChampionTest extends TestCase
{
    public function test champion has ChampionRegistered event on registration(): void
    {
        $champion = Champion::register(
            new ChampionId('fake-id'),
            new VersionNumber('0.0.0'),
            new ChampionName('Fakename'),
            new ChampionImageUrl('fake-image-url')
        );

        $registeredChampionRegisteredEvents = array_filter($champion->registeredEvents(), function ($event): bool {
            return $event instanceof ChampionRegistered;
        });

        $this->assertSame(1, \count($registeredChampionRegisteredEvents));
    }
}
