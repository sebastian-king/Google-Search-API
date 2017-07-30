# Google-Search-API
A PHP-based API for getting Google Search results

To use the scraper to display Google search results for your website, you just need to enter the base domain name of your website in the `config.php` file and then include `api.php` whereever you would like to deploy the search.

The usage is simple once the script has been included, simply call the `search` function with the argument `query` and optional argument `timeout (seconds)`, like so:

```
search($query, $timeout = 5) {
	...
}

search("dragons") {
	...
}

search($_GET['query'], $timeout = 5) {
	...
}
```
