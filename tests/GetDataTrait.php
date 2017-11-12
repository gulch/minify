<?php

namespace gulch\Minify\Tests;

trait GetDataTrait
{
    protected function getSourceCode(): string
    {
        return \file_get_contents(__DIR__ . '/data/' . \str_replace(__NAMESPACE__ . '\\', '', __CLASS__) . '.html');
    }

    protected function getMinifiedCode(): string
    {
        return \file_get_contents(__DIR__ . '/data/' . \str_replace(__NAMESPACE__ . '\\', '', __CLASS__) . '.min.html');
    }
}