<?php declare(strict_types=1);

namespace Criterja\gherkin;

class Background implements CriteriaGroup{

    const BACKGROUND_TITLE_INDEX = 'title';
    const BACKGROUND_STEPS_INDEX = 'steps';

    private $title = '';
    private $steps = [];

    public function __construct(string $title, Step ...$steps)
    {
        $this->title = $title;
        $this->steps = $steps;
    }

    public function getKeyword(): string
    {
        return 'Background';
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    public function asArray(): array
    {
        $steps = $this->steps;

        return [
            self::BACKGROUND_TITLE_INDEX => $this->title,
            self::BACKGROUND_STEPS_INDEX => \array_map(function (Step $step) {
                return $step->asArray();      
            }, $this->steps)
        ];
    }

}