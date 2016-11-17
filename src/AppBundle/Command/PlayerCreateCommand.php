<?php

namespace AppBundle\Command;

use AppBundle\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\{
    InputArgument, InputInterface, InputOption
};
use Symfony\Component\Console\Output\OutputInterface;

class PlayerCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('player:create')
            ->setDescription('Create a test player.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $player = $this->getContainer()->get('player.manager')->create(['pseudo' => 'TestNeofox2', 'password' => 'azeaze', 'email' => 'neo2@neocah.fr']);
        $output->writeln("{$player->getPseudo()} with the id {$player->getId()} as been created.");
    }

}
