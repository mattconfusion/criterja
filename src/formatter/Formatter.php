<?php declare(strict_types=1);

namespace Criterja\formatter;

use Criterja\gherkin\Background;
use Criterja\gherkin\Feature;
use Criterja\gherkin\Scenario;
use Criterja\gherkin\Table;

interface Formatter {

    public function printFeature(Feature $feature): string;

    public function printBackground(Background $background): string;

    public function printScenario(Scenario $scenario): string;

    public function printExampleTable(Table $table): string;

    public function printSectionBreak(): string;

}