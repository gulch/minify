<?php

namespace gulch\Minify\Processor;

use gulch\Minify\Contract\ProcessorInterface;

class QuotesRemover extends Replacer implements ProcessorInterface
{
    function getReplacePatternData(): array
    {
        return [
            '/src="(.*?)"/' => 'src=$1',
            '/width="(.*?)"/' => 'width=$1',
            '/height="(.*?)"/' => 'height=$1',
            '/name="(.*?)"/' => 'name=$1',
            '/charset="(.*?)"/' => 'charset=$1',
            '/align="(.*?)"/' => 'align=$1',
            '/border="(.*?)"/' => 'border=$1',
            '/crossorigin="(.*?)"/' => 'crossorigin=$1',
            '/type="(.*?)"/' => 'type=$1',
            '/\/>/' => '>',
        ];
    }
}