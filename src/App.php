<?php declare(strict_types=1);

namespace Criterja;

use Criterja\formatter\FormatType;
use Criterja\utils\FeatureFile;
use Criterja\gherkin\AcceptanceCriteria;
use Criterja\utils\FormatConverterFactory;
use Criterja\utils\FileWriterFactory;

class App {

    /**
     * Runs the Criterja app
     *
     * @param string $filename
     * @param FormatType $outputFormat
     * @return string The converted file name and path
     */
    public function run(string $filename, FormatType $outputFormat): string
    {
        $file = new FeatureFile($filename);
        $ac = new AcceptanceCriteria($file);
        $converter = FormatConverterFactory::createConverter($ac, $outputFormat);
        $writer = FileWriterFactory::createFileWriter(
            $outputFormat, 
            $filename,
            $converter->convert()
        );
        $writer->write();
        return $writer->getFileName();
    }
}