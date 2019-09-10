<?php declare(strict_types=1);

namespace App\Application\CommandBus;

final class CommandBus implements IExecuteCommands
{
    private $handlers;

    public function __construct(CommandHandlerMap $commandHandlerMap)
    {
        $this->handlers = $commandHandlerMap->handlers();
    }

    /**
     * @throws CommandHandlerNotFound
     * @throws MissingInvokeOnCommandHandler
     */
    public function execute($command): void
    {
        $commandClass = \get_class($command);

        if (!isset($this->handlers[$commandClass])) {
            throw new CommandHandlerNotFound();
        }

        if (!is_callable($this->handlers[$commandClass])) {
            throw new MissingInvokeOnCommandHandler();
        }

        ($this->handlers[$commandClass])($command);
    }
}
