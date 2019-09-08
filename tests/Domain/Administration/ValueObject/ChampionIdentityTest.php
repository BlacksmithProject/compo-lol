<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\ValueObject;

use App\Domain\Administration\ValueObject\ChampionId;
use App\Domain\Administration\ValueObject\ChampionIdentity;
use App\Domain\Administration\ValueObject\VersionNumber;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ChampionIdentityTest extends TestCase
{
    public function test that name cannot be blank(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('champion_name.must_not_be_blank');

        new ChampionIdentity(
            new ChampionId('fakeId'),
            new VersionNumber('0.0.0'),
            '',
            'fake-image-url'
        );
    }

    public function test that imageUrl cannot be blank(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('champion_image_url.must_not_be_blank');

        new ChampionIdentity(
            new ChampionId('fakeId'),
            new VersionNumber('0.0.0'),
            'Fakename',
            ''
        );
    }

    public function test it can be initialized(): void
    {
        $championId = new ChampionId('fakeId');
        $versionNumber = new VersionNumber('0.0.0');

        $championIdentity =new ChampionIdentity(
            $championId,
            $versionNumber,
            'Fakename',
            'fake-image-url'
        );

        $this->assertSame($championId, $championIdentity->id());
        $this->assertSame($versionNumber, $championIdentity->versionNumber());
        $this->assertSame('Fakename', $championIdentity->name());
        $this->assertSame('fake-image-url', $championIdentity->imageUrl());
    }
}
