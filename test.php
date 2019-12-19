<?php declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Criterja\gherkin\AcceptanceCriteria;
use Criterja\utils\FeatureFile;
use Criterja\gherkin\Step;
use Criterja\gherkin\Scenario;
use Criterja\gherkin\ScenarioType;
use Criterja\gherkin\ScenarioTypeFactory;

$file = new FeatureFile(__DIR__ . DIRECTORY_SEPARATOR . 'test.feature');

$ac = new AcceptanceCriteria($file);

echo "Feature: " . $ac->getFeature()->getTitle() . PHP_EOL;
$desc = $ac->getFeature()->getDescription();
\array_walk($desc, function (string $line) {
    echo $line . PHP_EOL;
});
echo PHP_EOL;

echo "Background: " . $ac->getBackground()->getTitle() . PHP_EOL;
$steps = $ac->getBackground()->getSteps();
\array_walk($steps, function (Step $step) {
    echo $step->getKeyword() . ' ' . $step->getCondition() . PHP_EOL;
});

echo "Scenarios" . PHP_EOL;
var_dump($ac->getScenarios());




