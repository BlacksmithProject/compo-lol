<?php declare(strict_types=1);

namespace App\Domain\Administration\ValueObject\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static ChampionRole ASSASSIN()
 * @method static ChampionRole FIGHTER()
 * @method static ChampionRole MAGE()
 * @method static ChampionRole MARKSMAN()
 * @method static ChampionRole SUPPORT()
 * @method static ChampionRole TANK()
 */
final class ChampionRole extends Enum
{
    private const ASSASSIN = 'assassin';
    private const FIGHTER = 'fighter';
    private const MAGE = 'mage';
    private const MARKSMAN = 'marksman';
    private const SUPPORT = 'support';
    private const TANK = 'tank';
}
