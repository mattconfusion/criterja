<?php declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Criterja\gherkin\AcceptanceCriteria;
use Criterja\utils\FeatureFile;
use Criterja\formatter\MarkdownFormatter;
use Criterja\gherkin\Scenario;

$file = new FeatureFile(__DIR__ . DIRECTORY_SEPARATOR . 'test.feature');

$ac = new AcceptanceCriteria($file);
$mdf = new MarkdownFormatter();

echo $mdf->printFeature($ac->getFeature());
echo $mdf->printSectionBreak();
echo $mdf->printBackground($ac->getBackground());
echo $mdf->printSectionBreak();

$scenarios = $ac->getScenarios();
\array_walk($scenarios, function (Scenario $scenario) use ($mdf) {
    echo $mdf->printScenario($scenario);
    echo $mdf->printSectionBreak();

    if ($scenario->hasExamples()) {
        echo $mdf->printExampleTable($scenario->getExamples());
        echo $mdf->printSectionBreak();
    }
});
