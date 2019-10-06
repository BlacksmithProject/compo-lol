<?php declare(strict_types=1);

namespace App\Tests\Administration\Domain\Entity;

use App\Administration\Domain\Entity\Champion;
use App\Administration\Domain\Event\ChampionRegistered;
use App\Administration\Domain\ValueObject\ChampionId;
use App\Administration\Domain\ValueObject\ChampionIdentity;
use App\Administration\Domain\ValueObject\ChampionImageUrl;
use App\Administration\Domain\ValueObject\ChampionName;
use App\Administration\Domain\ValueObject\VersionNumber;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class ChampionTest extends TestCase
{
    public function test champion has ChampionRegistered event on registration(): void
    {
        $champion = Champion::register(
            new ChampionIdentity(Uuid::uuid4()),
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
