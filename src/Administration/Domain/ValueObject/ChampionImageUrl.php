<?php declare(strict_types=1);

namespace App\Administration\Domain\ValueObject;

use Assert\Assert;

final class ChampionImageUrl
{
    private $url;

    public function __construct(string $url)
    {
        Assert::that($url)->notBlank("champion_image_url.must_not_be_blank");

        $this->url = $url;
    }

    public function __toString(): string
    {
        return $this->url;
    }
}
