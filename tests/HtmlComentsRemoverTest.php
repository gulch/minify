<?php

namespace gulch\Minify\Tests;

use gulch\Minify\Minifier;
use gulch\Minify\Processor\HtmlCommentsRemover;
use PHPUnit\Framework\TestCase;

class HtmlCommentsRemoverTest extends TestCase
{
    /** @test */
    public function testHtmlCommentsRemover()
    {
        $minifier = new Minifier(new HtmlCommentsRemover);

        $source = '<!--[if IE]>
                       <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                   <![endif]-->
                   <!-- HTML Comment -->';

        $result = '<!--[if IE]>
                       <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                   <![endif]-->';

        $this->assertSame(
            $result,
            $minifier->process($source)
        );
    }
}
