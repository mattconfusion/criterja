<?php declare(strict_types=1);

namespace Criterja\gherkin;

class DocStringArgument {

    private $lines = [];

    public function __construct(string ...$lines)
    {
        $this->lines = $lines;
    }

    public function getLines(): array
    {
        return $this->lines;
    }
}