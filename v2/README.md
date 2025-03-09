# The News API project - v2

In v2 of the News API Project, Docker and Symfony (version 5+) are used to manage the environment and execute code via 
CLI, so that the news information can be returned without using a client interface. 

### Setup
To get started, follow these steps:

### Step 1: Build the Docker container
```
docker compose build --no-cache
```
This command will create the Docker container for the application.

### Step 2: Run the Docker container
```
docker compose run --rm cli bash
```
This command will start the container and give you access to a bash shell.

### Step 3: Fetch the latest news
Inside the container, run the following Symfony command to fetch news data:
```
php bin/console.php app:fetch-news
```
This will retrieve the latest news headlines, descriptions, and publication dates.

## Additional Features
This project also includes static code analysis and code styling tools:

PHPStan: A static analysis tool for finding bugs in the code. Run it with:
```
vendor/bin/phpstan
```

PHPCodeSniffer: A tool to detect coding standard violations. To find errors, run:
```
vendor/bin/phpcs
```

PHPCodeBeautifier and Fixer: Automatically corrects coding standard violations. Run it with:
```
vendor/bin/phpcbf
```

By using Docker and Symfony, this project ensures a consistent development environment and easy command-line 
interaction. The integration of PHPStan and PHPCodeSniffer further helps maintain clean, bug-free code.

