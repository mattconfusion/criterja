<?php declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Criterja\formatter\FormatType;
use Criterja\gherkin\AcceptanceCriteria;
use Criterja\utils\FeatureFile;
use Criterja\utils\FileWriter;
use Criterja\utils\FormatConverterFactory;

$filePath = $argv[1] ?? __DIR__ . DIRECTORY_SEPARATOR . 'test.feature';
$file = new FeatureFile($filePath);

$ac = new AcceptanceCriteria($file);
$converter = FormatConverterFactory::createConverter($ac, FormatType::MARKDOWN());
$writer = (new FileWriter($filePath . '.md', $converter->convert()))->write();

echo ($converter->convert());