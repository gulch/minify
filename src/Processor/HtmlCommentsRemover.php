<?php

namespace gulch\Minify\Processor;

use gulch\Minify\Contract\ProcessorInterface;

// Remove comments from HTML Code (non-MSIE conditionals)
class HtmlCommentsRemover extends Replacer implements ProcessorInterface
{
    public function getReplacePatternData(): array
    {
        return [
            '{\s*<!--[^\[<>].*(?<!!)-->\s*}msU' => ''
        ];
    }
}
