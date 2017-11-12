<?php

namespace gulch\Minify\Processor;

use gulch\Minify\Contract\ProcessorInterface;

class WhitespacesRemover implements ProcessorInterface
{
    private const BLOCK_ELEMENTS = [
        'address',
        'article',
        'aside',
        'audio',
        'blockquote',
        'body',
        'br',
        'button',
        'canvas',
        'col',
        'colgroup',
        'dd',
        'div',
        'dl',
        'dt',
        'embed',
        'fieldset',
        'figcaption',
        'figure',
        'footer',
        'form',
        'h[1-6]',
        'head',
        'header',
        'hgroup',
        'hr',
        'html',
        'li',
        'link',
        'map',
        'meta',
        'noscript',
        'object',
        'ol',
        'output',
        'p',
        'progress',
        'script',
        'section',
        'style',
        'table',
        'tbody',
        'td',
        'tfoot',
        'th',
        'thead',
        'title',
        'tr',
        'ul',
        'video'
    ];

    public function process(string $buffer): string
    {
        // Find all the <pre>,<code>,<textarea>, and <javascript> tags
        // We'll want to return them to this unprocessed state later.
        preg_match_all('{<pre.+</pre>}msU', $buffer, $pres_source);
        preg_match_all('{<code.+</code>}msU', $buffer, $codes_source);
        preg_match_all('{<textarea.+</textarea>}msU', $buffer, $textareas_source);
        preg_match_all('{<script.+</script>}msU', $buffer, $javascript_source);

        // Replace multiple spaces with a single space.
        $buffer = preg_replace('/\s{2,}/', ' ', $buffer);

        // Remove spaces around block-level elements.
        $buffer = preg_replace(
            '/\s*(<\/?(' . implode('|', self::BLOCK_ELEMENTS) . ')[^>]*>)\s*/is', '$1',
            $buffer
        );

        // Replace edited <pre> tags with unprocessed ones.
        if (\sizeof($pres_source)) {
            preg_match_all('{<pre.+</pre>}msU', $buffer, $pres_edited);
            $buffer = str_replace($pres_edited[0], $pres_source[0], $buffer);
        }

        // Replace edited <code> tags with unprocessed ones.
        if (\sizeof($codes_source)) {
            preg_match_all('{<code.+</code>}msU', $buffer, $codes_edited);
            $buffer = str_replace($codes_edited[0], $codes_source[0], $buffer);
        }

        // Replace edited <textarea> tags with unprocessed ones.
        if (\sizeof($textareas_source)) {
            preg_match_all('{<textarea.+</textarea>}msU', $buffer, $textareas_edited);
            $buffer = str_replace($textareas_edited[0], $textareas_source[0], $buffer);
        }

        // Replace edited <script> tags with unprocessed ones.
        if (\sizeof($javascript_source)) {
            preg_match_all('{<script.+</script>}msU', $buffer, $javascript_edited);
            $buffer = str_replace($javascript_edited[0], $javascript_source[0], $buffer);
        }

        return $buffer;
    }
}