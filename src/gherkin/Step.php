<?php declare(strict_types=1);

namespace Criterja\gherkin;

class Step {

    private $keyword;
    private $condition;
    private $arguments = [];

    public function __construct(string $keyword, string $condition, DocStringArgument ...$arguments)
    {
        $this->keyword = $keyword;
        $this->condition = $condition;
        $this->arguments = $arguments;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function hasArguments(): bool
    {
        return \count($this->arguments) > 0;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function asArray(): array
    {
        return [$this->keyword => $this->condition];
    }
}