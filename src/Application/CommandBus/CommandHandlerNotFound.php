<?php declare(strict_types=1);

namespace App\Application\CommandBus;

use App\Application\ApplicationException;

final class CommandHandlerNotFound extends ApplicationException
{
}
