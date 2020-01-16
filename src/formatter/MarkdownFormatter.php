<?php declare(strict_types=1);

namespace Criterja\formatter;

use Criterja\gherkin\Background;
use Criterja\gherkin\Feature;
use Criterja\gherkin\Scenario;
use Criterja\gherkin\Table;

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

        \array_unshift($featureLines, 'Feature: ' . $feature->getTitle());

        return $this->renderAsMultiLineText($featureLines);
    }

    public function printBackground(Background $background): string
    {
        return '';
    }

    public function printScenario(Scenario $scenario): string
    {
        return '';
    }

    public function printExampleTable(Table $table): string
    {
        return '';
    }

    public function printSectionBreak(): string
    {
        return '';
    }

    private function italicText(string $text): string
    {
        return "*$text*";
    }

    private function boldText(string $text): string
    {
        return "**$text**";
    }

    private function padText(string $text): string
    {
        return "  $text";
    }

    private function renderAsMultiLineText(array $strings): string
    {
        return \implode("\r\n", $strings) . "\r\n";
    }
}