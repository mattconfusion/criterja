<?php declare(strict_types=1);

namespace Criterja\gherkin;

use MyCLabs\Enum\Enum;
class ScenarioType extends Enum {
    private const SCENARIO = 'Scenario';
    private const SCENARIO_OUTLINE = 'Scenario Outline';
}