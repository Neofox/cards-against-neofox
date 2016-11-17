<?php

namespace AppBundle\Command;

use AppBundle\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\{
    InputArgument, InputInterface, InputOption
};
use Symfony\Component\Console\Output\OutputInterface;

class DeckDeleteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('deck:delete')
            ->setDescription('Delete a test deck')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $deck = $container->get('deck.manager')->findByName('Test Deck');
        if($deck) {$container->get('deck.manager')->delete($deck);}

        $output->writeln("deck \"Test Deck\" deleted.");
    }

}
