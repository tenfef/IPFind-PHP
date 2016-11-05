# IPFind-PHP

A simple class for getting a users location from their IP Address. The class uses [IP Find - IP Geolocation API](https://ipfind.co/) as the backend API for this service.

## Installation

Install the latest version with

```bash
$ composer require tenfef/ipfind-php
```

## Basic Usage

```php
<?php

use Tenfef\IPFind\IPFind;

// create a log channel
$ipfind = new IPFind();
$result = $ipfind->fetchIPAddress('8.8.8.8');
var_dump($result);

/*
object(stdClass)#2 (14) {
  ["ip_address"]=>
  string(7) "8.8.8.8"
  ["country"]=>
  string(13) "United States"
  ["country_code"]=>
  string(2) "US"
  ["continent"]=>
  string(13) "North America"
  ["continent_code"]=>
  string(2) "NA"
  ["city"]=>
  string(13) "Mountain View"
  ["county"]=>
  string(11) "Santa Clara/
  ["region"]=>
  string(10) "California"
  ["region_code"]=>
  string(2) "CA"
  ["timezone"]=>
  string(3) "PST"
  ["owner"]=>
  string(26) "LEVEL 3 COMMUNICATIONS INC"
  ["longitude"]=>
  float(-122.0865)
  ["latitude"]=>
  float(37.3801)
  ["warning"]=>
  string(131) "You are not using an IP Find API Key. You are limited to 100 requests/day. Register for free at https://ipfind.co for higher limits"
}
*/

```

## Documentation

- [Usage Instructions](https://ipfind.co/docs)
- [Get an API Key](https://ipfind.co/)

### License

IP Find is licensed under the MIT License
