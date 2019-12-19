<?php declare(strict_types=1);

namespace Criterja\gherkin;

class Scenario implements CriteriaGroup {

    const SCENARIO_TITLE_INDEX = 'title';
    const SCENARIO_STEPS_INDEX = 'steps';
    const SCENARIO_TYPE_INDEX = 'type';
    
    private $title = '';
    private $steps = [];
    private $scenarioType;

    public function __construct(ScenarioType $scenarioType, string $title, ?Step ...$steps)
    {
        $this->scenarioType = $scenarioType;
        $this->title = $title;
        $this->steps = $steps;
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
}