<?php

namespace gulch\Minify\Tests;

use gulch\Minify\Minifier;
use gulch\Minify\Processor\AttributesSimplifier;
use PHPUnit\Framework\TestCase;

class AttributesSimplifierTest extends TestCase
{
    public function testAttributesSimplifier()
    {
        $minifier = new Minifier(new AttributesSimplifier);

        $source = '<form method="GET">
                <input type="text" disabled="disabled">
                <input type="text" readonly="readonly">
                <select name="abc">
                    <option selected="selected"></option>
                </select>
            </form>
            <script async="true" src="/a.js"></script>
            <script defer="defer" src="/b.js"></script>';

        $result = '<form>
                <input type="text" disabled>
                <input type="text" readonly>
                <select name="abc">
                    <option selected></option>
                </select>
            </form>
            <script async src="/a.js"></script>
            <script defer src="/b.js"></script>';

        $this->assertSame(
            $result,
            $minifier->process($source)
        );
    }
}
