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
    public function isNewerThan(VersionNumber $versionToCompareWith): bool
    {
        list(
            $major,
            $minor,
            $patch
            ) = explode('.', $this->value);

        list(
            $majorToCompareWith,
            $minorToCompareWith,
            $patchToCompareWith
            ) = explode('.', $versionToCompareWith->value);

        if ($major !== $majorToCompareWith) {
            return $major > $majorToCompareWith;
        }

        if ($minor !== $minorToCompareWith) {
            return $minor > $minorToCompareWith;
        }

        return $patch >= $patchToCompareWith;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
