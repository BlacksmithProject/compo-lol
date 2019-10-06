<?php declare(strict_types=1);

namespace App\BuildingBlocks\Domain;

use Throwable;

final class CannotRebuildEventFromData extends \Exception
{
    public function __construct(string $className, $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Class %s cannot be rebuilt with provided data', $className);
        parent::__construct($message, $code, $previous);
    }
}
