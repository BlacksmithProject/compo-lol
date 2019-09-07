<?php declare(strict_types=1);

namespace App\Domain\Administration\ValueObject\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static DamageType PHYSICAL()
 * @method static DamageType MAGICAL()
 */
final class DamageType extends Enum
{
    private const PHYSICAL = 'physical';
    private const MAGICAL = 'magical';
}
