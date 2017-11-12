<?php

namespace gulch\Minify\Processor;

abstract class Replacer
{
    abstract function getReplacePatternData(): array;

    public function process(string $buffer): string
    {
        return $this->replace(
            $this->getReplacePatternData(),
            $buffer
        );
    }

    public function replace(array $replace, string $buffer): string
    {
        $result = preg_replace(
            array_keys($replace),
            array_values($replace),
            $buffer
        );

        return ($result === null) ? $buffer : $result;
    }
}