<?php declare(strict_types=1);

namespace App\Tests\Application\CommandBus\Stub;

final class FakeCommandHandler
{
    public function __invoke(FakeCommand $command): void
    {
        $command->property++;
    }
}
