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
// default optimizations are: whitespaces remove, html comments remove, minification of css and js code
$minified_code = $minifier->process($code);
```
### Advanced optimizations
```php
$minifier = new gulch\Minify\Minifier(
    new gulch\Minify\Processor\WhitespacesRemover,
    new gulch\Minify\Processor\HtmlCommentsRemover,
    new gulch\Minify\Processor\InlineCssMinifier,
    new gulch\Minify\Processor\InlineJavascriptMinifier,
    new gulch\Minify\Processor\QuotesRemover,
    new gulch\Minify\Processor\AttributesSimplifier
);
$minified_code = $minifier->process($code);
```
