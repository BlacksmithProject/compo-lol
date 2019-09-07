<?php declare(strict_types=1);

namespace App\Domain\Administration\ValueObject;

use Assert\Assert;

/**
 * Holds VersionNumber under the format "Major.Minor.Patch"
 */
final class VersionNumber
{
    private const VALID_VERSION_NUMBER_REGEX = '/[0-9]+\.[0-9]+\.[0-9]/m';

    /** @var string */
    private $value;

    public function __construct(string $versionNumber)
    {
        Assert::lazy()
            ->that($versionNumber, 'versionNumber')
                ->notBlank('version_number.must_not_be_blank')
                ->regex(
                    static::VALID_VERSION_NUMBER_REGEX,
                    'version_number.must_have_a_major_and_a_minor_and_a_patch_numbers'
                )
            ->verifyNow();

        $this->value = $versionNumber;
    }

    /**
     * Checks if current VersionNumber is more recent than provided one.
     *
     * Compares major, then minor, then patch.
     */
    public function isNewerThan(self $versionToCompareWith): bool
    {
        if ($this->getMajor($this) !== $this->getMajor($versionToCompareWith)) {
            return $this->getMajor($this) > $this->getMajor($versionToCompareWith);
        }

        if ($this->getMinor($this) !== $this->getMinor($versionToCompareWith)) {
            return $this->getMinor($this) > $this->getMinor($versionToCompareWith);
        }

        if ($this->getPatch($this) !== $this->getPatch($versionToCompareWith)) {
            return $this->getPatch($this) > $this->getPatch($versionToCompareWith);
        }

        return true;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function getMajor(self $version): int
    {
        return (int) explode('.', $version->__toString())[0];
    }

    private function getMinor(self $version): int
    {
        return (int) explode('.', $version->__toString())[1];
    }

    private function getPatch(self $version): int
    {
        return (int) explode('.', $version->__toString())[2];
    }
}
