<?php

namespace AppBundle\Command;

use AppBundle\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\{
    InputArgument, InputInterface, InputOption
};
use Symfony\Component\Console\Output\OutputInterface;

class GamePlayCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('game:play')
            ->setDescription('Play a test game.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gameManager = $this->getContainer()->get('game.manager');
        $playerManager = $this->getContainer()->get('player.manager');
        $deckManager = $this->getContainer()->get('deck.manager');

        $output->writeln("Getting a game...");
        $game = $gameManager->findOneBy(['name' => "Test Game"]);

        $output->writeln("Using a deck...");
        $deck = $deckManager->findOneBy(['name' => 'test deck']);
        $gameManager->addDeck($game, $deck);

        $output->writeln("Adding 2 players...");
        $player1 = $playerManager->findOneBy(['name' => "TestNeofox"]);
        $player2 = $playerManager->findOneBy(['name' => "TestNeofox2"]);
        $gameManager->addPlayer($game, $player1);
        $gameManager->addPlayer($game, $player2);

        $output->writeln("Starting THE GAME...");
        $gameManager->start($game);

        $output->writeln("Starting round...");
        sleep(1);

        $output->writeln("Distributing cards to all players...");
        $gameManager->fillAllHands($game);

        $output->writeln("Choosing a Tzar");
        $gameManager->pickTzar($game);


    }

}
