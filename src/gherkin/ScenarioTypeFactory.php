<?php

declare(strict_types=1);

namespace Criterja\gherkin;

use Criterja\gherkin\ScenarioType;
use Behat\Gherkin\Node\ScenarioInterface;
use InvalidArgumentException;

class ScenarioTypeFactory
{

    /**
     * Creates the correct scenario type based on keyword
     *
     * @param ScenarioInterface $scenario (depends on Behat library)
     * @return ScenarioType
     */
    public static function createType(ScenarioInterface $scenario): ScenarioType
    {
        switch ($scenario->getKeyword()) {
            case 'Scenario':
                return ScenarioType::SCENARIO();
            case 'Scenario Outline':
                return ScenarioType::SCENARIO_OUTLINE();
            default:
                throw new InvalidArgumentException(
                    'Unknown scenario keyword: ' . $scenario->getKeyword()
                );
        }
    }
}
