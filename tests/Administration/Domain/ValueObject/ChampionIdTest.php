<?php declare(strict_types=1);

namespace App\Tests\Administration\Domain\ValueObject;

use App\Administration\Domain\ValueObject\ChampionId;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ChampionIdTest extends TestCase
{
    public function test id cannot be blank(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('champion_id.must_not_be_blank');

        new ChampionId('');
    }
}
