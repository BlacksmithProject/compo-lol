<?php declare(strict_types=1);

namespace App\Tests\Domain\Administration\ValueObject;

use App\Domain\Administration\ValueObject\VersionNumber;
use Assert\LazyAssertionException;
use PHPUnit\Framework\TestCase;

final class VersionNumberTest extends TestCase
{
    public function test that version number cannot be blank(): void
    {
        $this->expectException(LazyAssertionException::class);
        $this->expectExceptionMessage('version_number.must_not_be_blank');

        new VersionNumber('');
    }

    public function test that version number must be formatted with a minor and a patch number(): void
    {
        $this->expectException(LazyAssertionException::class);
        $this->expectExceptionMessage('version_number.must_have_a_major_and_a_minor_and_a_patch_numbers');

        new VersionNumber('9');
    }

    public function test that version number must be formatted with a patch number(): void
    {
        $this->expectException(LazyAssertionException::class);
        $this->expectExceptionMessage('version_number.must_have_a_major_and_a_minor_and_a_patch_numbers');

        new VersionNumber('9.12');
    }

    public function test it can be initialized(): void
    {
        $versionNumber = new VersionNumber('9.12.1');

        $this->assertSame('9.12.1', $versionNumber->__toString());
    }

    public function test that an higher major version is more recent(): void
    {
        $versionNumber = new VersionNumber('2.0.0');
        $versionNumberToCompareWith = new VersionNumber('1.0.0');

        $this->assertTrue($versionNumber->isNewerThan($versionNumberToCompareWith));
    }

    public function test that an higher minor version is more recent(): void
    {
        $versionNumber = new VersionNumber('0.2.0');
        $versionNumberToCompareWith = new VersionNumber('0.1.0');

        $this->assertTrue($versionNumber->isNewerThan($versionNumberToCompareWith));
    }

    public function test that an higher patch version is more recent(): void
    {
        $versionNumber = new VersionNumber('0.0.2');
        $versionNumberToCompareWith = new VersionNumber('0.0.1');

        $this->assertTrue($versionNumber->isNewerThan($versionNumberToCompareWith));
    }

    public function test that an higher major version with a lower minor version is more recent(): void
    {
        $versionNumber = new VersionNumber('2.0.0');
        $versionNumberToCompareWith = new VersionNumber('1.1.1');

        $this->assertTrue($versionNumber->isNewerThan($versionNumberToCompareWith));
    }

    public function test that an higher minor version with a lower patch version is more recent(): void
    {
        $versionNumber = new VersionNumber('0.2.0');
        $versionNumberToCompareWith = new VersionNumber('0.1.1');

        $this->assertTrue($versionNumber->isNewerThan($versionNumberToCompareWith));
    }

    public function test that a same version is more recent(): void
    {
        $versionNumber = new VersionNumber('1.0.0');
        $versionNumberToCompareWith = new VersionNumber('1.0.0');

        $this->assertTrue($versionNumber->isNewerThan($versionNumberToCompareWith));
    }
}
