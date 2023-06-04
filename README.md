[![Coverage Status](https://coveralls.io/repos/github/gulch/minify/badge.svg?branch=master)](https://coveralls.io/github/gulch/minify?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gulch/minify/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gulch/minify/?branch=master)

# gulch/Minify
PHP Package for minify HTML code.

## Install

You will need [Composer](http://getcomposer.org) installed.
```bash
composer require gulch/minify
```

## How to use
```php
$minifier = gulch\Minify\Minifier::createDefault();
// default optimizations are: whitespaces remove, html comments remove, minification of css and js code
// above code is equivalent to:
// $minifier = new gulch\Minify\Minifier(
//     new gulch\Minify\Processor\WhitespacesRemover,
//     new gulch\Minify\Processor\HtmlCommentsRemover,
//     new gulch\Minify\Processor\InlineCssMinifier,
//     new gulch\Minify\Processor\InlineJavascriptMinifier,
// );
$minified_code = $minifier->process($code);
```
### Advanced optimizations
```php
$minifier = new gulch\Minify\Minifier(
    new gulch\Minify\Processor\WhitespacesRemover,
    new gulch\Minify\Processor\HtmlCommentsRemover,
    new gulch\Minify\Processor\InlineCssMinifier,
    new gulch\Minify\Processor\InlineJavascriptMinifier,
    new gulch\Minify\Processor\AttributesSimplifier,
    new gulch\Minify\Processor\AttributeQuotesRemover,
);
$minified_code = $minifier->process($code);
```
