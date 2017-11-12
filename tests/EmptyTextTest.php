<?php

namespace gulch\Minify\Tests;

use gulch\Minify\Minifier;
use PHPUnit\Framework\TestCase;

class EmptyTextTest extends TestCase
{
    public function testEmptyTextMinification()
    {
        $minifier = Minifier::createDefault();
        $this->assertSame('', $minifier->process(''));
    }
}
