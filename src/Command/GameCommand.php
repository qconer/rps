<?php

namespace App\Command;

use App\Game;
use App\Player;
use App\Randomize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GameCommand extends Command
{
    protected static  $defaultName = 'app:game';

    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setDescription('Star new game.')
             ->setHelp('The game is played automatically by default 100 games');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $randomizer = new Randomize();
        $mike = (new Player($randomizer))->setName('Mike');
        $gorge = (new Player($randomizer))->setName('Gorge');

        $game = (new Game())->addPlayers($mike, $gorge)->play();

        $output->writeln($game->getScore());

        return 0;
    }
}
