<?php

namespace gulch\Minify;

use gulch\Minify\Contract\ProcessorInterface;
use gulch\Minify\Processor\HtmlCommentsRemover;
use gulch\Minify\Processor\InlineCssMinifier;
use gulch\Minify\Processor\InlineJavascriptMinifier;
use gulch\Minify\Processor\WhitespacesRemover;

class Minifier implements ProcessorInterface
{
    /** @var array */
    private $processors;

    public function __construct(ProcessorInterface ...$processors)
    {
        $this->processors = $processors;
    }

    public function process(string $buffer): string
    {
        foreach ($this->processors as $processor) {
            $buffer = $processor->process($buffer);
        }

        return $buffer;
    }

    public function addProcessor(ProcessorInterface $processor): self
    {
        $this->processors[] = $processor;

        return $this;
    }

    public static function createDefault(): self
    {
        return new self(
            new WhitespacesRemover,
            new InlineCssMinifier,
            new InlineJavascriptMinifier,
            new HtmlCommentsRemover
        );
    }
}
