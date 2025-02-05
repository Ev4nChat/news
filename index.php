<?php

// Load Composer Autoloader and environment variables
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
include 'header.php';

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

$response = file_get_contents($url, false, $context);

if (!$response) {
    echo "<h1>No news found</h1>";
}

$data = json_decode($response, true);

header('Content-Type: text/html; charset=UTF-8');

// Basic error checks
if (!isset($data['data']) || !is_array($data['data'])) {
    echo "<h1>No news found or an error occurred.</h1>";
    exit;
}

// Loop through each news item and display it
foreach ($data['data'] as $newsItem) {
    $headline    = $newsItem['title']       ?? 'No Headline';
    $description = $newsItem['description'] ?? 'No Description';
    $dateString  = $newsItem['published_at'] ?? null;

    // Format the date if available
    if ($dateString) {
        try {
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d/m/Y H:i');
        } catch (Exception $e) {
            $formattedDate = 'Invalid date';
        }
    } else {
        $formattedDate = 'No date';
    }

    //Print news data
    echo "<article>";
    echo "<p>$formattedDate</p>";
    echo "<h2>" . htmlspecialchars($headline) . "</h2>";
    echo "<p>" . nl2br(htmlspecialchars($description)) . "</p>";
    echo "</article>";
}