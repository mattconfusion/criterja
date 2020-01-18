<?php declare(strict_types=1);

namespace Criterja\utils;

use Criterja\formatter\FormatType;
use Criterja\formatter\MarkdownFormatter;
use Criterja\gherkin\AcceptanceCriteria;

class FormatConverterFactory {

    /**
     * Creates a correctly set up FormatConverter according to the type of conversion requested.
     *
     * @param AcceptanceCriteria $ac
     * @param FormatType $type
     * @return FormatConverter
     */
    public static function createConverter(AcceptanceCriteria $ac, FormatType $type): FormatConverter
    {
        switch ($type) {
            case FormatType::MARKDOWN(): 
                return new FormatConverter($ac, new MarkdownFormatter());    
        }   
    }
}