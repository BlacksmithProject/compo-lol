<?php declare(strict_types=1);

namespace App\Domain\Administration\ValueObject;

use Assert\Assert;

final class ChampionName
{
    private $value;

    public function __construct(string $name)
    {
        Assert::that($name)->notBlank('champion_name.must_not_be_blank');

        $this->value = $name;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
