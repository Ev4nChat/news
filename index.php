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

$contextOptions = [
    "http" => [
        "header" => "User-Agent: MyNewsScript/1.0\r\n"
    ]
];
$context = stream_context_create($contextOptions);

$response = @file_get_contents($url, false, $context);
$data = json_decode($response, true);

header('Content-Type: text/html; charset=UTF-8');

// Basic error checks
if (!$response || !isset($data['data']) || !is_array($data['data'])) {
    echo "<h1>No news found or an error occurred.</h1>";
    exit;
}