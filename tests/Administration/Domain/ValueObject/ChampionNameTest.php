<?php declare(strict_types=1);

namespace App\Tests\Administration\Domain\ValueObject;

use App\Administration\Domain\ValueObject\ChampionName;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ChampionNameTest extends TestCase
{
    public function test name cannot be blank()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('champion_name.must_not_be_blank');

        new ChampionName('');
    }
}
