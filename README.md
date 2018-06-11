# NEWS TITLE CHECKER

Find if a site is Marfeelizable (contains the word NEWS or NOTICIAS in the TITLE tag)

## Getting Started

This project uses:

- Slim Framework to manage API calls
- Guzzle to perform CURL operations
- SQLite3 to store results
- PHPUnit to perfom tests

Slim,Guzzle and PHPUnit have been installed using Composer. Any details can be found in composer.json

I've been using POSTMAN to send requests to API.

### Folders

- SRC folder contains a class to manage the Database
- DATABASE folder contains the sqlite database file
- TESTS contains a file to perfoms a few very basic tests
- PUBLIC contains the main entry file INDEX.PHP


### INPUT

INPUT is done by POST sending the list or URLs in JSON format.


### OUTPUT

OUTPUT returns several fields in JSON format:

- STATUS : can be 'OK' or 'TIMEOUT' in case request timed out
- URL : returns input url
- TITLE : returns title of website
- MARFEELIZABLE : returns YES if title contains the words 'news' or 'noticias' or NO if it doesn't

In the root folder there is a file called resultsOK.json that contains the output for the JSON file that was attached as a reference in the email.


## Running the server

`php -S localhost:8888 -t public public/index.php`


## Running the tests

`php vendor/bin/phpunit tests/curlTest.php`


## Built With

* [Slim Framework](http://slimframework.com) - The framework used
* [Guzzle](http://guzzlephp.org) - for HTTP Requests
* [PHPUnit](http://phpunit.de) - Used for testing
* [SQLite3](http://sqlite.org) - Used for database

## Authors

* **David** - *Initial work*