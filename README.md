# Google-Search-API
A PHP-based API for getting Google Search results

To use the scraper to display Google search results for your website, you just need to enter the base domain name of your website in the `config.php` file and then include `api.php` whereever you would like to deploy the search.

The usage is simple once the script has been included, simply call the `search` function with the argument `query` and optional argument `timeout (seconds)`, like so:

```
// config.php: define("SITE", "example.com");
// function header: search($query, $timeout = 5, $site_domain = SITE) { ... }

$results = search("dragons");

$results = search($_GET['query'], 5, "example.com");
```

If a site domain is provided as a third argument to the funcfion, it will overwrite the site specified on the config file.

The above function will search Google specifically for web pages on your website, as defined in your config.php file, in this case it is `example.com` and display the results on your website as your own personal search page.

The function will return `false` should it receive a captcha verification from Google. It is recommended to use this function with something such as proxies that can bypass Google's search limits.

A backup search option is provided in case the scrape function fails or receives a captcha, this options uses Google's [CSE API](https://developers.google.com/custom-search/json-api/v1/overview) and therefore needs a CSE ID and API Key and which can be found at https://cse.google.com/cse/ and https://developers.google.com/custom-search/json-api/v1/overview. Once you have these they can be entered in the config file.

The backup search option can easily be implemented as failover, like so:
```
if (!$results = search($query)) {
  $results = cse_search($query);
}
```

If you exceed your CSE search quota, the function `cse_search` will return false.
