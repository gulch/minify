<?php

declare(strict_types=1);

namespace gulch\Minify\Tests;

use PHPUnit\Framework\TestCase;
use gulch\Minify\Minifier;
use gulch\Minify\Processor\AttributesSimplifier;
use gulch\Minify\Processor\HtmlCommentsRemover;
use gulch\Minify\Processor\InlineCssMinifier;
use gulch\Minify\Processor\InlineJavascriptMinifier;
use gulch\Minify\Processor\QuotesRemover;
use gulch\Minify\Processor\WhitespacesRemover;

class MinifierFullTest extends TestCase
{
    use GetDataTrait;

    /** @test */
    public function testMinifierWithFullOptions()
    {
        $minifier = new Minifier(
            new WhitespacesRemover,
            new HtmlCommentsRemover,
            new InlineCssMinifier,
            new InlineJavascriptMinifier
        );

        $minifier->addProcessor(new QuotesRemover);
        $minifier->addProcessor(new AttributesSimplifier);

        $this->assertSame(
            $minifier->process($this->getSourceCode()),
            $this->getMinifiedCode()
        );
    }
}