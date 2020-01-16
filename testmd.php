<?php declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Criterja\gherkin\AcceptanceCriteria;
use Criterja\utils\FeatureFile;
use Criterja\formatter\MarkdownFormatter;
use Criterja\gherkin\Scenario;
use Criterja\utils\FormatConverter;

$filePath = $argv[1] ?? __DIR__ . DIRECTORY_SEPARATOR . 'test.feature';
$file = new FeatureFile($filePath);

$ac = new AcceptanceCriteria($file);
$mdf = new MarkdownFormatter();
$converter = new FormatConverter($ac, $mdf);

// echo $mdf->printFeature($ac->getFeature());
// echo $mdf->printSectionBreak();
// echo $mdf->printBackground($ac->getBackground());
// echo $mdf->printSectionBreak();

// $scenarios = $ac->getScenarios();
// \array_walk($scenarios, function (Scenario $scenario) use ($mdf) {
//     echo $mdf->printScenario($scenario);
//     echo $mdf->printSectionBreak();

//     if ($scenario->hasExamples()) {
//         echo $mdf->printExampleTable($scenario->getExamples());
//         echo $mdf->printSectionBreak();
//     }
// });

echo $converter->convert();