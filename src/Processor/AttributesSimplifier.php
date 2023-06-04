<?php

namespace gulch\Minify\Processor;

use gulch\Minify\Contract\ProcessorInterface;

class AttributesSimplifier extends Replacer implements ProcessorInterface
{
    public function getReplacePatternData(): array
    {
        return [
            '/ allowfullscreen=[^ >]*(.*?)/' => ' allowfullscreen',
            '/ async=[^ >]*(.*?)/' => ' async',
            '/ autofocus=[^ >]*(.*?)/' => ' autofocus',
            '/ autoplay=[^ >]*(.*?)/' => ' autoplay',
            '/ checked=[^ >]*(.*?)/' => ' checked',
            '/ controls=[^ >]*(.*?)/' => ' controls',
            '/ defer=[^ >]*(.*?)/' => ' defer',
            '/ disabled=[^ >]*(.*?)/' => ' disabled',
            '/ formnovalidate=[^ >]*(.*?)/' => ' formnovalidate',
            '/ itemscope=[^ >]*(.*?)/' => ' itemscope',
            '/ loop=[^ >]*(.*?)/' => ' loop',
            '/ method=("get"|get)/i' => '',
            '/ multiple=[^ >]*(.*?)/' => ' multiple',
            '/ muted=[^ >]*(.*?)/' => ' muted',
            '/ nomodule=[^ >]*(.*?)/' => ' nomodule',
            '/ novalidate=[^ >]*(.*?)/' => ' novalidate',
            '/ open=[^ >]*(.*?)/' => ' open',
            '/ open=[^ >]*(.*?)/' => ' open',
            '/ readonly=[^ >]*(.*?)/' => ' readonly',
            '/ required=[^ >]*(.*?)/' => ' required',
            '/ selected=[^ >]*(.*?)/' => ' selected',
        ];
    }
}
