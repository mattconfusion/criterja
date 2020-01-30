<?php declare(strict_types=1);

namespace Criterja\utils;

use Criterja\formatter\FormatType;

class FileWriterFactory {

    public function createFileWriter(FormatType $format, string $filename, string $contents): FileWriter
    {
        switch ($format) {
            case FormatType::MARKDOWN():
            default:
                $extension = FileExtension::MARKDOWN();
        }

        return new FileWriter($filename . '.' . $extension, $contents);
    }
}