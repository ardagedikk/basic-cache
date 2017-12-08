# Basic Cache

> Simple and fast caching class that uses the file system for caching

<p align="center">
<a href="https://travis-ci.org/ardagedikk/basic-cache"><img src="https://travis-ci.org/ardagedikk/basic-cache.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/ardagedik/basic-cache"><img src="https://poser.pugx.org/ardagedik/basic-cache/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/ardagedik/basic-cache"><img src="https://poser.pugx.org/ardagedik/basic-cache/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/ardagedik/basic-cache"><img src="https://poser.pugx.org/ardagedik/basic-cache/license.svg" alt="License"></a>
</p>

## Features

* Minifying the source code of the cache file
* Determining the extension of the cache file
* Encrypts file names with MD5

## Install

```sh
composer require ardagedik/basic-cache
```

## Usage
```php
<?php
    require_once('vendor/autoload.php');
    use ArdaGedik\BasicCache;
    
    $cache = new BasicCache();
?>
```
```php
<?php 
  $cache->start(); 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Basic Cache Example</title>
  </head>
  <body>
    <h1>Hello World</h1>
  </body>
</html>

<?php 
  $cache->end();
?>
```

## Options

```php
// These options are assigned by default
$cache = new BasicCache([
  "path"      => "cache/",
  "expire"    => 60,
  "extension" => ".html"
]);
```
```php
// Clear all cache files
$cache->clear();
```


## License

MIT