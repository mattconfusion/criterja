<?php declare(strict_types=1);

namespace Criterja\formatter;

use Criterja\gherkin\Background;
use Criterja\gherkin\DocStringArgument;
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
        $steps = $this->formatStepsAndArguments(...$background->getSteps());

        $this->addSectionTitleToSectionLines(
            $this->boldText('Background'), 
            $this->italictext($background->getTitle()), 
            $steps
        );
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
        $steps = $this->formatStepsAndArguments(...$scenario->getSteps());

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
        $tHeadSeparator = $this->padText($this->endTableHeader($table->getColumnsCount()));

        $rows = \array_map(function (array $row) {
            return $this->padtext($this->makeTableRow($row));
        }, $table->getRows());
        
        $table = \array_merge([$tHead, $tHeadSeparator], $rows);
        $this->addSectionTitleToSectionLines($this->boldText('Examples'), '', $table);
        return $this->renderAsMultiLineText($table);
    }

    public function printSectionBreak(): string
    {
        return "\r\n\r\n";
    }

    /**
     * Formats steps and arguments in an array of strings
     *
     * @param Step ...$steps
     * @return array
     */
    private function formatStepsAndArguments(Step ...$steps): array
    {
        return \array_map(function (Step $step) {
            $stepline = $this->padText($this->formatStep($step));
            if ($step->hasArguments()) {
                $stepline .= "\r\n" . $this->formatArguments(...$step->getArguments());
            }
            return $stepline;
        }, $steps);
    }

    private function formatStep(Step $step): string
    {
        return $this->boldText($step->getKeyword()) . ' ' . $step->getCondition();
    }

    private function formatArguments(DocStringArgument ...$arguments): string
    {
        $snippets = \array_map(function (DocStringArgument $arg) {
            return $this->codeSnippet(...$arg->getLines());
        }, $arguments);

        return $this->renderAsMultiLineText($snippets);
    }

    private function addSectionTitleToSectionLines(string $keyword, string $title, array &$sectionLines)
    {
        \array_unshift($sectionLines, $keyword .': ' . $title);
    }

    private function renderAsMultiLineText(array $strings): string
    {
        return \implode("\r\n", $strings) . "\r\n";
    }

    // Markdown formatting

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

    private function endTableHeader(int $columnsCount): string
    {
        return \implode(" | ", \array_fill(0, $columnsCount, '---'));
    }

    private function makeTableRow(array $rowValues): string
    {
        return \implode(" | ", $rowValues);
    }

    private function codeSnippet(string ...$lines): string
    {
        \array_unshift($lines, '```');
        $lines[] = '```';
        return \implode("\n", $lines);
    }
}