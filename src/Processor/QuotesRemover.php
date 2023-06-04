<?php

namespace gulch\Minify\Processor;

use gulch\Minify\Contract\ProcessorInterface;

/**
 * @deprecated deprecated since version 1.1
 */
class QuotesRemover extends Replacer implements ProcessorInterface
{
    public function getReplacePatternData(): array
    {
        return [
            '/\/>/' => '>',
            '/align="([^\s]*?)"/' => 'align=$1',
            '/border="([^\s]*?)"/' => 'border=$1',
            '/charset="([^\s]*?)"/' => 'charset=$1',
            /* '/content="([^\s]*?)"/' => 'content=$1', */
            '/crossorigin="([^\s]*?)"/' => 'crossorigin=$1',
            '/height="([^\s]*?)"/' => 'height=$1',
            '/name="([^\s]*?)"/' => 'name=$1',
            '/src="([^\s]*?)"/' => 'src=$1',
            '/type="([^\s]*?)"/' => 'type=$1',
            '/width="([^\s]*?)"/' => 'width=$1',
        ];
    }
}
