<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\GreetCommand;

// Create a new Console Application instance.
$application = new Application();

// Register your custom command.
$application->add(new GreetCommand());

// Run the application.
$application->run();






