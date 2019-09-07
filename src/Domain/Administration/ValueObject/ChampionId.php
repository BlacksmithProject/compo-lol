<?php declare(strict_types=1);

namespace App\Domain\Administration\ValueObject;

use Assert\Assert;

final class ChampionId
{
    private $id;

    public function __construct(string $id)
    {
        Assert::that($id)->notBlank('champion_id.must_not_be_blank');
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
