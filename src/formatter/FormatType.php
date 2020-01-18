<?php declare(strict_types=1);

namespace Criterja\formatter;

use MyCLabs\Enum\Enum;

class FormatType extends Enum {
    private const MARKDOWN = 'Markdown';
    private const HTML = 'HTML';
}