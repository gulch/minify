<?php

declare(strict_types=1);

namespace gulch\Minify\Tests;

use PHPUnit\Framework\TestCase;
use gulch\Minify\Minifier;

class MinifierDefaultTest extends TestCase
{
    use GetDataTrait;

    /** @test */
    public function testMinifierByDefaultOptions()
    {
        $minifier = Minifier::createDefault();

        $this->assertSame(
            $minifier->process($this->getSourceCode()),
            $this->getMinifiedCode()
        );
    }
}