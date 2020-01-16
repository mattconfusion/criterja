<?php declare(strict_types=1);

namespace Criterja\formatter;

use Criterja\gherkin\Background;
use Criterja\gherkin\Feature;
use Criterja\gherkin\Scenario;
use Criterja\gherkin\Table;
use Criterja\gherkin\Step;

class MarkdownFormatter implements Formatter {
    
    /**
     * Prints the feature section
     *
     * @param Feature $feature
     * @return string
     */
    public function printFeature(Feature $feature): string
    {
        $featureLines = \array_map([$this, 'padText'], $feature->getDescription());
        $this->addSectionTitleToSectionLines($this->boldText('Feature'), $this->italicText($feature->getTitle()), $featureLines);
        return $this->renderAsMultiLineText($featureLines);
    }

    /**
     * Prints the Background section
     *
     * @param Background $background
     * @return string
     */
    public function printBackground(Background $background): string
    {
        $steps = \array_map(function (Step $step) {
            return $this->padText($this->formatStep($step));
        }, $background->getSteps());

        $this->addSectionTitleToSectionLines($this->boldText('Background'), $this->italictext($background->getTitle()), $steps);
        return $this->renderAsMultiLineText($steps);
    }

    /**
     * Prints the formatted scenario (without examples)
     *
     * @param Scenario $scenario
     * @return string
     */
    public function printScenario(Scenario $scenario): string
    {
        $steps = \array_map(function (Step $step) {
            return $this->padText($this->formatStep($step));
        }, $scenario->getSteps());

        $this->addSectionTitleToSectionLines(
            $this->boldText($scenario->getKeyword()),
            $this->italicText($scenario->getTitle()),
            $steps
        );

        return $this->renderAsMultiLineText($steps);
    }

    public function printExampleTable(Table $table): string
    {
        $tHead = $this->padText($this->makeTableRow($table->getColumnsNames()));

        $rows = \array_map(function (array $row) {
            return $this->padtext($this->makeTableRow($row));
        }, $table->getRows());
        
        $table = \array_merge([$tHead], $rows);
        $this->addSectionTitleToSectionLines($this->boldText('Examples'), '', $table);
        return $this->renderAsMultiLineText($table);
    }

    public function printSectionBreak(): string
    {
        return "\r\n\r\n";
    }

    private function formatStep(Step $step): string
    {
        return $this->boldText($step->getKeyword()) . ' ' . $step->getCondition();
    }

    private function addSectionTitleToSectionLines(string $keyword, string $title, array &$sectionLines)
    {
        \array_unshift($sectionLines, $keyword .': ' . $title);
    }

    private function italicText(string $text): string
    {
        return $text ? "*$text*" : '';
    }

    private function boldText(string $text): string
    {
        return $text ? "**$text**" : '';
    }

    private function padText(string $text): string
    {
        return $text ? "  $text" : '';
    }

    private function makeTableCell(string $text): string
    {
        return $text ? "| $text |" : "| - |";
    }

    private function makeTableRow(array $rowValues): string
    {
        return "| " . \implode(" | ", $rowValues) . " | \r";
    }

    private function renderAsMultiLineText(array $strings): string
    {
        return \implode("\r\n", $strings) . "\r\n";
    }
}