<?php declare(strict_types=1);

namespace App\Domain\Administration\ValueObject;

use Assert\Assert;

final class ChampionIdentity
{
    /** @var ChampionId */
    private $id;
    /** @var VersionNumber */
    private $versionNumber;
    /** @var string */
    private $name;
    /** @var string */
    private $imageUrl;

    public function __construct(
        ChampionId $id,
        VersionNumber $versionNumber,
        string $name,
        string $imageUrl
    ) {
        Assert::lazy()
            ->that($name, 'name')->notBlank('champion_name.must_not_be_blank')
            ->that($imageUrl, 'imageUrl')->notBlank('champion_image_url.must_not_be_blank')
            ->verifyNow();

        $this->id = $id;
        $this->versionNumber = $versionNumber;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
    }

    public function id(): ChampionId
    {
        return $this->id;
    }

    public function versionNumber(): VersionNumber
    {
        return $this->versionNumber;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function imageUrl(): string
    {
        return $this->imageUrl;
    }
}
