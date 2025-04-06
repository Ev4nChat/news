<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\GreetCommand;
use App\Command\NewsFetchCommand;
use Symfony\Component\DependencyInjection\ContainerBuilder;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

/** @var ContainerBuilder $container */
$container = require_once __DIR__ . '/../config/services.php';

// Create a new Console Application instance.
$application = new Application();

// Register your custom commands.
/** @var Symfony\Component\Console\Command\Command $command */
$application->add($container->get('app.command.fetch_news'));

// Run the application.
$application->run();
