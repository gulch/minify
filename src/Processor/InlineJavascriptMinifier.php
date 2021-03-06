<?php

namespace gulch\Minify\Processor;

use gulch\Minify\Contract\ProcessorInterface;

class InlineJavascriptMinifier implements ProcessorInterface
{
    public function process(string $buffer): string
    {
        if (\strlen($buffer) === 0) {
            return '';
        }

        $javascript_minified = [];
        \preg_match_all('{<script.+</script>}msU', $buffer, $script_blocks);

        // Minify the javascript in <script> tags.
        foreach ($script_blocks[0] as $block) {
            $javascript_minified[] = $this->minifyJavascript($block);
        }

        if (\sizeof($javascript_minified)) {
            $buffer = \str_replace($script_blocks[0], $javascript_minified, $buffer);
        }

        return $buffer;
    }

    private function minifyJavascript(string $buffer): string
    {
        $tags = ['close' => \strrchr($buffer, '<')];
        $open_length = \strpos($buffer, '>') + 1;
        $tags['open'] = \substr($buffer, 0, $open_length);
        $buffer = \substr($buffer, $open_length, -\strlen($tags['close']));

        // Strip spaces from the tags
        $tags = \preg_replace('/\s{2,}/', ' ', $tags);

        // Catch all string literals and comment blocks
        if (\preg_match_all(
            '#((?:((?<!\\\)\'|")|(/\*)|(//)).*(?(2)(?<!\\\)\2|(?(3)\*/|\n)))#msuUS',
            $buffer,
            $match,
            \PREG_OFFSET_CAPTURE
        )) {
            $js_literals = $js_code = [];
            for ($match = $match[0], $c = \count($match), $i = $pos = $offset = 0; $i < $c; $i++) {
                $js_code[$pos++] = \trim(\substr($buffer, $offset, $match[$i][1] - $offset));
                $offset = $match[$i][1] + \strlen($match[$i][0]);

                // Save only if we haven't matched a comment block
                if ($match[$i][0][0] !== '/') {
                    $js_literals[$pos++] = \array_shift($match[$i]);
                }
            }
            $js_code[$pos] = \substr($buffer, $offset);

            // $match might be quite large, so free it up together with other vars that we no longer need
            unset($match, $offset, $pos);
        } else {
            $js_code = [$buffer];
            $js_literals = [];
        }

        // Standartize new lines
        $js_code = \str_replace(["\r\n", "\r"], "\n", $js_code);

        $patterns = [
            // Remove spaces following and preceeding JS-wise non-special & non-word characters
            '#\s*([!\#%&()*+,\-./:;<=>?@\[\]^`{|}~])\s*#' => '$1',
            // Reduce the remaining multiple whitespace characters to a single space
            '#\s{2,}#' => ' ',
        ];

        $js_code = \preg_replace(
            \array_keys($patterns),
            \array_values($patterns),
            $js_code
        );

        // Glue back JS quoted strings
        $js_code += $js_literals;
        \ksort($js_code);
        $buffer = \implode($js_code);

        return $tags['open'] . $buffer . $tags['close'];
    }
}
