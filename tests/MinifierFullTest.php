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

final class MinifierFullTest extends TestCase
{
    use GetDataTrait;

    /** @test */
    public function testMinifierWithFullOptions(): void
    {
        $minifier = new Minifier(
            new WhitespacesRemover,
            new HtmlCommentsRemover,
            new InlineCssMinifier,
            new InlineJavascriptMinifier,
            new QuotesRemover,
            new AttributesSimplifier,
        );

        $this->assertSame(
            $minifier->process($this->getSourceCode()),
            $this->getMinifiedCode()
        );
    }
}
