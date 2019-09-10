<?php declare(strict_types=1);

namespace App\Tests\Application\CommandBus\Stub;

final class InvalidFakeCommandHandler
{
    public function execute(InvalidFakeCommand $command): void
    {
        $command->property++;
    }
}
