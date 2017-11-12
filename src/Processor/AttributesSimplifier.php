<?php

namespace gulch\Minify\Processor;

use gulch\Minify\Contract\ProcessorInterface;

class AttributesSimplifier extends Replacer implements ProcessorInterface
{
    function getReplacePatternData(): array
    {
        return [
            '/ method=("get"|get)/i' => '',
            '/ disabled=[^ >]*(.*?)/' => ' disabled',
            '/ readonly=[^ >]*(.*?)/' => ' readonly',
            '/ selected=[^ >]*(.*?)/' => ' selected',
            '/ async=[^ >]*(.*?)/' => ' async',
            '/ defer=[^ >]*(.*?)/' => ' defer',
        ];
    }
}