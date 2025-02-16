<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use DateTime;

class NewsFetchCommand extends Command
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        parent::__construct();
        $this->httpClient = $httpClient;
    }

    protected function configure()
    {
        $this->setName('app:fetch-news')
             ->setDescription('Fetches the latest news using TheNewsAPI');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->httpClient->request('GET', 'https://api.thenewsapi.com/v1/news/top?locale=us&language=en', [
            'headers' => [
                'Authorization' => 'Bearer ' . getenv('API_TOKEN'),
            ],
        ]);

        if (!$response) {
            echo "<h1>No news found</h1>";
            exit;
        }

        $data = $response->toArray();

        if (!isset($data['data']) || !is_array($data['data'])) {
            echo "<h1>No news found or an error occurred.</h1>";
            exit;
        }

        foreach ($data['data'] as $article) {
            $dateString  = $article['published_at'] ?? null;

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

            $output->writeln($article['title']);
            $output->writeln($article['description']);
            $output->writeln('Published on: ' . $formattedDate);
            $output->writeln('---');
        }

        return Command::SUCCESS;
    }
}

