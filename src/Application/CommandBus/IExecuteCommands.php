<?php declare(strict_types=1);

namespace App\Application\CommandBus;

interface IExecuteCommands
{
    public function execute($command): void;
}
