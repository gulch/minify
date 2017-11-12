<?php

declare(strict_types=1);

namespace gulch\Minify\Tests;

use PHPUnit\Framework\TestCase;
use gulch\Minify\Minifier;

class MinifierDefaultTest extends TestCase
{
    use GetDataTrait;

    public function testMinifierByDefaultOptions()
    {
        $minifier = Minifier::createDefault();

        $this->assertEquals(
            $minifier->process($this->getSourceCode()),
            $this->getMinifiedCode()
        );
    }
}