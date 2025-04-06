<?php

namespace App\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsFetchCommand extends Command
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    protected function configure(): void
    {
        $this->setName('app:fetch-news')
            ->setDescription('Fetches the latest news using TheNewsAPI');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $API_TOKEN = isset($_ENV['API_TOKEN']) && is_string($_ENV['API_TOKEN']) ? $_ENV['API_TOKEN'] : '';

        try {
            $response = $this->client->request('GET', 'https://api.thenewsapi.com/v1/news/top?locale=us&language=en', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $API_TOKEN

                    ,
                ],
            ]);
        } catch(Exception $e) {
            $output->writeln("No news found or an error occurred.");
            return Command::FAILURE;
        }

        $data = $response->toArray();

        if (!isset($data['data']) || !is_array($data['data'])) {
            $output->writeln("No news found or an error occurred.");
            return Command::FAILURE;
        }

        foreach ($data['data'] as $article) {
            if (!is_array($article)) {
                continue;
            }
            $dateString  = $article['published_at'] ?? null;

            if (is_string($dateString)) {
                try {
                    $date = new \DateTime($dateString);
                    $formattedDate = $date->format('d/m/Y H:i');
                } catch (\Exception $e) {
                    $formattedDate = 'Invalid date';
                }
            } else {
                $formattedDate = 'No date';
            }

            $title = isset($article['title']) && is_string($article['title']) ? (string) $article['title'] : 'No title';
            $description = isset($article['description']) && is_string($article['description'])
                ? (string) $article['description']
                : 'No description';

            $output->writeln("<info>$title</info>");
            $output->writeln("<comment>$description</comment>");
            $output->writeln('Published on: ' . $formattedDate);
            $output->writeln('---');
        }

        return Command::SUCCESS;
    }
}
