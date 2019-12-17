<?php declare(strict_types=1);

namespace Criterja\gherkin;

class Step {

    private $keyword;
    private $condition;

    public function __construct(string $keyword, string $condition)
    {
        $this->keyword = $keyword;
        $this->condition = $condition;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function asArray(): array
    {
        return [$this->keyword => $this->condition];
    }
}