<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\ValueObject;

use App\Domain\Administration\ValueObject\ChampionImageUrl;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ChampionImageUrlTest extends TestCase
{
    public function test image url cannot be blank()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('champion_image_url.must_not_be_blank');

        new ChampionImageUrl('');
    }
}
