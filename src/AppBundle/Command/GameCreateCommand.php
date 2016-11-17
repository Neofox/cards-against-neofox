<?php

namespace AppBundle\Command;

use AppBundle\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\{
    InputArgument, InputInterface, InputOption
};
use Symfony\Component\Console\Output\OutputInterface;

class GameCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('game:create')
            ->setDescription('Create a test game.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $game = $this->getContainer()->get('game.manager')->create(['name' => 'Test Game', 'type' => Game::PUBLIC]);
        $output->writeln("{$game->getName()} with the id {$game->getId()} as been created.");
    }

}
