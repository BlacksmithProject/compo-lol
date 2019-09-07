<?php declare(strict_types=1);

namespace App\Domain\Administration\ValueObject\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static GamePeriodStrength EARLY_GAME()
 * @method static GamePeriodStrength MID_GAME()
 * @method static GamePeriodStrength LATE_GAME()
 */
final class GamePeriodStrength extends Enum
{
    private const EARLY_GAME = 'strongEarlygame';
    private const MID_GAME = 'strongMidgame';
    private const LATE_GAME = 'strongLategame';
}
