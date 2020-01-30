<?php declare(strict_types=1);

namespace Criterja\utils;

class FileWriter {

    private $fullPathToFile;
    private $contents;

    public function __construct(string $fullPathToFile, string $contents)
    {
        $this->fullPathToFile = $fullPathToFile;
        $this->contents = $contents;
    }

    public function write()
    {
        $result = \file_put_contents($this->fullPathToFile, $this->contents);

        if ($result === false) {
            throw new WriteErrorException();
        }
    }

    public function getFileName(): string
    {
        return $this->fullPathToFile;
    }

    public function getFileContents(): string
    {
        return $this->getFileContents();
    }
}