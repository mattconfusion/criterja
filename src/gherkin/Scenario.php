<?php declare(strict_types=1);

namespace Criterja\gherkin;

use InvalidArgumentException;

class Scenario implements CriteriaGroup {

    const SCENARIO_TITLE_INDEX = 'title';
    const SCENARIO_STEPS_INDEX = 'steps';
    const SCENARIO_TYPE_INDEX = 'type';
    
    private $title = '';
    private $steps = [];
    private $scenarioType;
    private $examples;

    public function __construct(ScenarioType $scenarioType, string $title, ?Table $table, ?Step ...$steps)
    {
        $this->scenarioType = $scenarioType;
        $this->title = $title;
        $this->examples = $table;
        $this->steps = $steps;

        if (!$this->isValid()) {
            throw new InvalidArgumentException('Scenario Outlines must have examples, Scenarios must not.');
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    public function getKeyword(): string
    {
        return $this->scenarioType->getValue();
    }

    public function hasExamples(): bool
    {
        return $this->scenarioType->equals(ScenarioType::SCENARIO_OUTLINE());
    }

    public function getExamples(): Table
    {
        return $this->examples;
    }

    private function isValid()
    {
        return ($this->scenarioType->equals(ScenarioType::SCENARIO_OUTLINE()) && $this->examples)
        || ($this->scenarioType->equals(ScenarioType::SCENARIO()) && !$this->examples); 
    }
}