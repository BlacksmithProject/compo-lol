<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\Event;

use App\Domain\Administration\Event\ChampionRegistered;
use App\Domain\Administration\ValueObject\ChampionId;
use App\Domain\Administration\ValueObject\ChampionImageUrl;
use App\Domain\Administration\ValueObject\ChampionName;
use App\Domain\Administration\ValueObject\VersionNumber;
use PHPUnit\Framework\TestCase;

final class ChampionRegisteredTest extends TestCase
{
    public function test it can be initialized(): void
    {
        $championId = new ChampionId('Fakename');
        $verionNumber = new VersionNumber('1.0.0');
        $championName = new ChampionName('Fakename');
        $championImageUrl = new ChampionImageUrl('fake-image-url');

        $event = new ChampionRegistered($championId, $verionNumber, $championName, $championImageUrl);

        $this->assertSame($championId, $event->championId());
        $this->assertSame($verionNumber, $event->versionNumber());
        $this->assertSame($championName, $event->championName());
        $this->assertSame($championImageUrl, $event->championImageUrl());
    }
}
