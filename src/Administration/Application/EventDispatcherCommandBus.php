<?php declare(strict_types=1);

namespace App\Administration\Application;

use BSP\CommandBus\Contracts\Command;
use BSP\CommandBus\Contracts\CommandBus;
use BSP\CommandBus\Exception\CommandHandlerIsNotCallable;
use BSP\CommandBus\Exception\CommandHandlerNotFound;
use BSP\CommandBus\SimpleCommandBus;

final class EventDispatcherCommandBus implements CommandBus
{
    /** @var SimpleCommandBus */
    private $commandBus;

    public function __construct(SimpleCommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Find the proper handler and use it to execute the provided command.
     *
     * @throws CommandHandlerNotFound
     * @throws CommandHandlerIsNotCallable
     */
    public function execute(Command $command): void
    {
        // TODO: Implement execute() method.
    }
}
