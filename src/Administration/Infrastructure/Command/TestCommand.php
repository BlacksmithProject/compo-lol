<?php declare(strict_types=1);

namespace App\Administration\Infrastructure\Command;

use App\Administration\Domain\Action\RegisterChampion\RegisterChampionCommand;
use App\Administration\Domain\ValueObject\ChampionId;
use App\Administration\Domain\ValueObject\ChampionIdentity;
use App\Administration\Domain\ValueObject\ChampionImageUrl;
use App\Administration\Domain\ValueObject\ChampionName;
use App\Administration\Domain\ValueObject\VersionNumber;
use BSP\CommandBus\Contracts\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class TestCommand extends Command
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus, string $name = null)
    {
        parent::__construct($name);
        $this->commandBus = $commandBus;
    }

    protected function configure()
    {
        $this->setName('champions:fetch');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new RegisterChampionCommand(
            new ChampionIdentity(Uuid::fromString('79359c0b-d5a3-4499-91f7-204410af4950')),
            new ChampionId('Aatrox'),
            new VersionNumber('9.16.1'),
            new ChampionName('Aatrox'),
            new ChampionImageUrl('https://www.google.fr')
        );

        $this->commandBus->execute($command);
    }
}
