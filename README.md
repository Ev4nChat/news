# The News API project
This project consumes the [NEWS API](https://api.thenewsapi.com), and specifically the API endpoint https://api.thenewsapi.com/v1/news/top in order to retrieve information related to the latest news. 
Once the data are retrieved, the code loops through them and stores only the headline, description, and the date each article was published, in order to be rendered by the client.

The first step for running this project is to visit the [news api website](https://www.thenewsapi.com/), create an account, and get an API token. 

Then, an `.env` file needs to be created, and the API token needs to be stored in the variable `API_TOKEN`.

To start the server, the following command should be executed: 
`php -S localhost:8000`, and then the project can be accessed by visiting `http://localhost:8000/index.php`.
