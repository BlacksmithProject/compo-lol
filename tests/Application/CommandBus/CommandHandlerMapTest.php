<?php declare(strict_types=1);

namespace App\Tests\Application\CommandBus;

use App\Application\CommandBus\CommandBus;
use App\Application\CommandBus\CommandHandlerMap;
use App\Application\CommandBus\CommandHandlerNotFound;
use App\Tests\Application\CommandBus\Stub\FakeCommand;
use App\Tests\Application\CommandBus\Stub\FakeCommandHandler;
use PHPUnit\Framework\TestCase;

final class CommandHandlerMapTest extends TestCase
{
    public function test it can be intialized without handlers(): void
    {
        $map = new CommandHandlerMap([]);

        $this->assertCount(0, $map->handlers());
    }

    public function test it can be intialized with handlers(): void
    {
        $map = new CommandHandlerMap([
            FakeCommand::class => new FakeCommandHandler(),
        ]);

        $this->assertCount(1, $map->handlers());
        $this->assertArrayHasKey(FakeCommand::class, $map->handlers());
        $this->assertInstanceOf(FakeCommandHandler::class, $map->handlers()[FakeCommand::class]);
    }

    public function test handlers can be added(): void
    {
        $map = new CommandHandlerMap([]);

        $map->add(new FakeCommandHandler());

        $this->assertCount(1, $map->handlers());
    }

    public function test adding not a handler is not working AND not failing but return nothing(): void
    {
        $map = new CommandHandlerMap([]);

        $map->add(new CommandHandlerNotFound());

        $this->assertCount(0, $map->handlers());
    }
}
