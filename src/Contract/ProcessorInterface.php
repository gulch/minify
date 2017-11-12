<?php

namespace gulch\Minify\Contract;

interface ProcessorInterface
{
    public function process(string $buffer): string;
}