<?php declare(strict_types=1);

namespace Criterja\utils;

use UnexpectedValueException;

class FeatureFile {

    private $fullPathToFile = '';

    public function __construct(string $fullPathToFile)
    {
        $this->fullPathToFile = $fullPathToFile;
    }

    public function getPath(): string
    {
        return $this->fullPathToFile;
    }

    public function getContents(): string
    {
        $contents = \file_get_contents($this->fullPathToFile);

        if ($contents === false) {
            throw new UnexpectedValueException('Unable to parse the content of the specified file');
        }

        return $contents;
    }
}