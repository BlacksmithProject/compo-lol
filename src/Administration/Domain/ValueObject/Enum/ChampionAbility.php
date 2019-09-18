<?php declare(strict_types=1);

namespace App\Administration\Domain\ValueObject\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static ChampionAbility HARD_ENGAGE()
 * @method static ChampionAbility HARD_CC()
 * @method static ChampionAbility WAVE_CLEAR()
 * @method static ChampionAbility DISENGAGE()
 * @method static ChampionAbility POKE()
 */
final class ChampionAbility extends Enum
{
    private const HARD_ENGAGE = 'hardEngage';
    private const HARD_CC = 'hardCrowdControl';
    private const WAVE_CLEAR = 'waveClear';
    private const DISENGAGE = 'disengage';
    private const POKE = 'poke';
}
