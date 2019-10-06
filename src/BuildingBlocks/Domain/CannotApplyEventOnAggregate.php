<?php declare(strict_types=1);

namespace App\BuildingBlocks\Domain;

use Throwable;

final class CannotApplyEventOnAggregate extends \Exception
{
    public function __construct(string $eventClass, string $aggregateClass, $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Cannot apply event "%s" on aggregate "%s"', $eventClass, $aggregateClass);
        parent::__construct($message, $code, $previous);
    }
}
