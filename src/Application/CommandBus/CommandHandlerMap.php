<?php declare(strict_types=1);

namespace App\Application\CommandBus;

final class CommandHandlerMap
{
    private $handlers = [];

    /**
     * @param iterable<string, callable> $handlers
     */
    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->add($handler);
        }
    }

    public function add($handler): void
    {
        $handlerClass = \get_class($handler);

        if ($this->stringEndsWith($handlerClass, 'CommandHandler')) {
            return;
        }

        $commandClass = $this->getCommandClass($handlerClass);

        $this->handlers[$commandClass] = $handler;
    }

    /**
     * @return array<string, object>
     */
    public function handlers(): array
    {
        return $this->handlers;
    }

    private function stringEndsWith(string $string, string $endWith): bool
    {
        return substr($string, -strlen($endWith)) !== $endWith;
    }

    private function getCommandClass(string $commandHandlerClass): string
    {
        $commandHandlerClassLength = strlen('Handler');

        return substr_replace($commandHandlerClass, '', -$commandHandlerClassLength, $commandHandlerClassLength);
    }
}
