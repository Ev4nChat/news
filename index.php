<?php

// Load Composer Autoloader and environment variables
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiToken = $_ENV['API_TOKEN'] ?? '';

$baseUrl = "https://api.thenewsapi.com/v1/news/top";
$queryParams = http_build_query([
    'locale'    => 'us',
    'language'  => 'en',
    'api_token' => $apiToken
]);
$url = $baseUrl . '?' . $queryParams;