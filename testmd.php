<?php declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Criterja\gherkin\AcceptanceCriteria;
use Criterja\utils\FeatureFile;
use Criterja\formatter\MarkdownFormatter;

$file = new FeatureFile(__DIR__ . DIRECTORY_SEPARATOR . 'test.feature');

$ac = new AcceptanceCriteria($file);
$mdf = new MarkdownFormatter();

echo $mdf->printFeature($ac->getFeature());