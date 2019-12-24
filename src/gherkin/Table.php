<?php declare(strict_types=1);

namespace Criterja\gherkin;

use InvalidArgumentException;

class Table {

    private $columns = [];
    private $columnsCount = 0;
    private $rows = [];

    /**
     * Creates a table naming columns and adding as many rows as you want
     *
     * @param array $columns
     * @param array ...$rows
     */
    public function __construct(array $columns, array ...$rows)
    {
        foreach ($columns as $col) {
            $this->columns[] = $col;
        }

        $this->columnsCount = \count($this->columns);

        foreach ($rows as $row) {
            if (\count($row) !== $this->columnsCount) {
                throw new InvalidArgumentException('Row columns do not match table columns');
            }
            $this->rows[] = $row;
        } 
    }

    /**
     * returns the names of the columns
     *
     * @return array
     */
    public function getColumnsNames(): array
    {
        return $this->columns;
    }

    /**
     * returns the rows of the table
     *
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }
}