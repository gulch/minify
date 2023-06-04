<?php

namespace gulch\Minify\Processor;

use gulch\Minify\Contract\ProcessorInterface;

use function preg_match_all, preg_replace, str_contains, str_replace, strlen;

class AttributeQuotesRemover implements ProcessorInterface
{
    public function process(string $buffer): string
    {
        if (strlen($buffer) === 0) {
            return '';
        }

        $matched_tags = [];

        // match tags
        preg_match_all('|<[\w]+[^>]*>|', $buffer, $matched_tags);

        $search_array = [];
        $replace_array = [];
        $counter = 0;

        foreach ($matched_tags[0] as $matched_tag) {

            if (false === str_contains($matched_tag, '"')) {
                continue;
            }

            // replace only name="value" to name=value
            // i.e. values with no whitespaces
            $new_tag = preg_replace(
                '|(\w+)="(\S+)"|i',
                '$1=$2',
                $matched_tag
            );

            $search_array[$counter] = $matched_tag;
            $replace_array[$counter] = $new_tag;

            ++$counter;
        }

        $buffer = str_replace($search_array, $replace_array, $buffer);

        return $buffer;
    }
}
