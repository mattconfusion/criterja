<?php declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Criterja\gherkin\AcceptanceCriteria;
use Criterja\utils\FeatureFile;
use Criterja\formatter\MarkdownFormatter;
use Criterja\utils\FileWriter;
use Criterja\utils\FormatConverter;

$filePath = $argv[1] ?? __DIR__ . DIRECTORY_SEPARATOR . 'test.feature';
$file = new FeatureFile($filePath);

$ac = new AcceptanceCriteria($file);
$mdf = new MarkdownFormatter();
$converter = new FormatConverter($ac, $mdf);
$writer = (new FileWriter($filePath . '.md', $converter->convert()))->write();

echo ($converter->convert());