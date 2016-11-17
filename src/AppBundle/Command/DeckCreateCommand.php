<?php

namespace AppBundle\Command;

use AppBundle\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\{
    InputArgument, InputInterface
};
use Symfony\Component\Console\Output\OutputInterface;

class DeckCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('deck:create')
            ->setDescription('Create a test deck')
            ->addArgument('cards', InputArgument::OPTIONAL, 'Number of cards in the deck', 10)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nbCards = $input->getArgument('cards');
        $deckManager = $this->getContainer()->get('deck.manager');
        $cardManager = $this->getContainer()->get('card.manager');
        $cards = [];

        $deck = $deckManager->create(['name' => 'test deck', 'description' => 'test description', 'packId' => 'XX123']);

        $blackCard = $cardManager->create(['text' => 'black card', 'type' => Card::BLACK, 'nbrAnswer' => 1]);
        $deckManager->addCard($blackCard, $deck);

        for($i = 0; $i < $nbCards; $i++) {
            $cards[] = $cardManager->create(['text' => time(), 'type' => Card::WHITE]);
        }
        $deckManager->addCards($cards, $deck);

        $output->writeln("deck {$deck->getName()} created with {$deck->getCards()->count()} cards with 1 black card.");
    }

}
