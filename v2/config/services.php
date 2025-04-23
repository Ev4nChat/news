<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpClient\HttpClient;
use App\Command\NewsFetchCommand;
use Symfony\Contracts\HttpClient\HttpClientInterface;

// Autoload and set up the container
require_once __DIR__ . '/../vendor/autoload.php';

$container = new ContainerBuilder();

// Register the HttpClientInterface service and use HttpClient::create() to instantiate it
$container->register(HttpClientInterface::class, HttpClientInterface::class)
    ->setFactory([HttpClient::class, 'create'])
    ->setPublic(true);  // Make the HttpClientInterface service public if needed

$container->register('app.command.fetch_news', NewsFetchCommand::class)
    ->addArgument(new Reference(HttpClientInterface::class))
    ->addTag('console.command');

// Return the container
return $container;
