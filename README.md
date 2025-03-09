# The News API Project
This project consumes the News API to retrieve the latest news information. It extracts the headline, description, and 
publication date of each news article to display on the client-side or via the command-line interface (CLI), 
depending on the version you're using.

There are two versions of the project, each with its own setup process:
- Version 1: This version uses a client interface to render the fetched news.
- Version 2: This version uses Docker and Symfony to manage the environment and execute code via the 
command-line interface (CLI), without relying on a client interface.

## Version 1 - Client Interface
In Version 1, the data is retrieved from the News API and rendered by a client on a local server.

### Setup
Visit the News API website and create an account to get an API token.

Create a `.env` file in the project root and add your API token in the variable `API_TOKEN`.

Start the local server by running the following command:
`php -S localhost:8000`

Access the project in your browser by visiting [http://localhost:8000/index.php](http://localhost:8000/index.php).

## Version 2 - CLI with Docker and Symfony
Version 2 removes the client interface and uses Docker and Symfony5+ to run the project via the command line.

### Setup
To get started with Version 2, follow these steps:

Build the Docker container:
`docker compose build --no-cache`

Run the Docker container:
`docker compose run --rm cli bash`

Fetch the latest news data:

Inside the container, run the following Symfony command to retrieve the news:

`php bin/console.php app:fetch-news`

This will retrieve the latest news headlines, descriptions, and publication dates.

## Additional Features
This version of the project includes static code analysis and code styling tools to help maintain clean and bug-free
code:

PHPStan: A static analysis tool to find bugs in the code. 

Run it with:

`vendor/bin/phpstan`

PHPCodeSniffer: A tool to detect coding standard violations. To find errors, run:

`vendor/bin/phpcs`

PHPCodeBeautifier and Fixer: Automatically corrects coding standard violations. 

Run it with:

`vendor/bin/phpcbf`

## Conclusion
Both versions of this project retrieve news data from the News API, but Version 1 is designed for a client-side 
interface, while Version 2 is a CLI-based implementation using Docker and Symfony5+.

