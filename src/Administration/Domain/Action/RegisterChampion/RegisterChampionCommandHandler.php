<?php declare(strict_types=1);

namespace App\Administration\Domain\Action\RegisterChampion;

use App\Administration\Domain\Entity\Champion;
use App\Administration\Domain\Exception\ChampionIdentityAlreadyUsed;
use App\Administration\Domain\Repository\IWriteChampions;

final class RegisterChampionCommandHandler
{
    private $championRepository;

    public function __construct(IWriteChampions $championRepository)
    {
        $this->championRepository = $championRepository;
    }

    /**
     * @throws ChampionIdentityAlreadyUsed
     */
    public function __invoke(RegisterChampionCommand $command): void
    {
        if ($this->championRepository->isIdAlreadyUsed($command->championId())) {
            throw new ChampionIdentityAlreadyUsed();
        }

        $champion = Champion::register(
            $command->championId(),
            $command->versionNumber(),
            $command->championName(),
            $command->championImageUrl()
        );

        $this->championRepository->add($champion);
    }
}
