<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('app:greet')
            ->setDescription('Prints a greeting message.')
            ->setHelp('This command outputs a friendly greeting.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello, this is your greeting command!');
        return Command::SUCCESS;
    }
}