[![Build Status](https://travis-ci.org/gulch/minify.svg?branch=master)](https://travis-ci.org/gulch/minify)

# gulch/Minify
PHP Package for minify HTML code.

## Install

You will need [Composer](http://getcomposer.org) installed.

Add to your **composer.json** file this git repo
```bash
"repositories":[
    {
	    "type": "git",
	    "url": "http://github.com/gulch/minify"
    }
]
```
and add to **require** section
```bash
"require": {
    "gulch/minify": "^0.1"
}
```
and finally run
```bash
composer update
```
## How to use
```php
$minifier = gulch\Minify\Minifier::createDefault();
$minified_code = $minifier->process($code);
```
