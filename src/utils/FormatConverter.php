<?php declare(strict_types=1);

namespace Criterja\utils;

use Criterja\formatter\Formatter;
use Criterja\gherkin\AcceptanceCriteria;
use Criterja\gherkin\Scenario;

class FormatConverter {
    private $formatter;
    private $ac;
    private $convertedString = '';

    public function __construct(AcceptanceCriteria $ac, Formatter $formatter)
    {
        $this->formatter = $formatter;
        $this->ac = $ac;
    }

    public function convert(): string
    {
        if ($this->convertedString) {
            return $this->convertedString;
        }

        $this->convertedString =  $this->formatter->printFeature($this->ac->getFeature());
        $this->convertedString .= $this->formatter->printSectionBreak();
        
        $background = $this->ac->getBackground();

        if ($background) {
            $this->convertedString .= $this->formatter->printBackground($background);
            $this->convertedString .= $this->formatter->printSectionBreak();
        }

        $scenarios = $this->ac->getScenarios(); 
        \array_walk($scenarios, function (Scenario $scenario) {
            $this->convertedString .=  $this->formatter->printScenario($scenario);
            $this->convertedString .=  $this->formatter->printSectionBreak();

            if ($scenario->hasExamples()) {
                $this->convertedString .=  $this->formatter->printExampleTable($scenario->getExamples());
                $this->convertedString .=  $this->formatter->printSectionBreak();
            }
        });

        return $this->convertedString;
    }
}