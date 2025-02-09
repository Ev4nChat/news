<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->httpClient->request('GET', 'https://api.thenewsapi.com/v1/news/top', [
            'headers' => [
                'Authorization' => 'Bearer ' . getenv('API_TOKEN'),
            ],
        ]);

        $data = $response->toArray();
        foreach ($data['data'] as $article) {
            $output->writeln($article['title']);
            $output->writeln($article['description']);
            $output->writeln('Published on: ' . $article['published_at']);
            $output->writeln('---');
        }

        return Command::SUCCESS;
    }
}
