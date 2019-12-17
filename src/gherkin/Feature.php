<?php declare(strict_types=1);

namespace Criterja\gherkin;

class Feature {

    const FEATURE_TITLE_INDEX = 'title';
    const FEATURE_DESC_INDEX = 'description';

    private $title = '';
    private $description = '';

    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): array
    {
        return \preg_split('/\r\n|\r|\n/', $this->description);
    }

    public function asArray(): array
    {
        return [
            self::FEATURE_TITLE_INDEX => $this->title,
            self::FEATURE_DESC_INDEX => $this->getDescription()
        ];
    }
}