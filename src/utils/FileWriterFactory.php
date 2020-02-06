<?php declare(strict_types=1);

namespace Criterja\utils;

use Criterja\formatter\FormatType;

class FileWriterFactory {

    public static function createFileWriter(FormatType $format, string $filename, string $contents): FileWriter
    {
        switch ($format) {
            case FormatType::HTML():
                $extension = FileExtension::HTML();
            case FormatType::MARKDOWN():
            default:
                $extension = FileExtension::MARKDOWN();
        }

        $fileToCreate = \explode(
            \pathinfo($filename, PATHINFO_EXTENSION),
            $filename
        )[0] . $extension;

        return new FileWriter($fileToCreate, $contents);
    }
}