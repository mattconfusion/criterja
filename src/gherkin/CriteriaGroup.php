<?php declare(strict_types=1);

namespace Criterja\gherkin;

interface CriteriaGroup {
    public function getKeyword(): string;
    public function getTitle(): ?string;
    public function getSteps(): array;
}