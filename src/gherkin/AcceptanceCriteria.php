<?php declare(strict_types=1);

namespace Criterja\gherkin;

use Behat\Gherkin\Lexer;
use Behat\Gherkin\Parser;
use Behat\Gherkin\Keywords\ArrayKeywords;
use Behat\Gherkin\Node\FeatureNode;
use Behat\Gherkin\Node\StepNode;
use Criterja\utils\FeatureFile;

class AcceptanceCriteria
{
    private $parsedFile = '';

    public function __construct(FeatureFile $featureFile)
    {
        $this->parsedFile = $this->parseFeatureFile($featureFile->getContents());
        var_dump($this->parsedFile);
    }

    /**
     * Get the feature part of the Feature file
     *
     * @return Feature|null
     */
    public function getFeature(): ?Feature
    {
        if ($this->parsedFile->getTitle() === '' && !$this->parsedFile->hasDescription()) {
            return null;
        }

        return new Feature(
            $this->parsedFile->getTitle() ?? '',
            $this->parsedFile->getDescription() ?? ''
        );
    }

    /**
     * Get the background part of the feature file
     *
     * @return Background|null
     */
    public function getBackground(): ?Background
    {
        if (!$this->parsedFile->hasBackground()) {
            return null;
        }

        return new Background(
            $this->parsedFile->getBackground()->getTitle() ?? '',
            ...$this->parseSteps(...$this->parsedFile->getBackground()->getSteps())
        );
    }

    public function getScenarios()
    {
        
    }

    /**
     * Parse StepNodes into an array of Step objects
     *
     * @param StepNode ...$stepnodes
     * @return Step[]
     */
    private function parseSteps(StepNode ...$stepnodes): array
    {
        $steps = [];
        foreach ($stepnodes as $stepnode) {
            $steps[] = new Step($stepnode->getKeyword(), $stepnode->getText());
        }

        return $steps;
    }

    /**
     * Parse the featre file content
     *
     * @param string $featureFileContents
     * @return FeatureNode
     */
    private function parseFeatureFile(string $featureFileContents): FeatureNode
    {
        $parser = new Parser($this->configureKeywords());
        return $parser->parse($featureFileContents);
    }

    /**
     * Configure the lexicon of the parser
     *
     * @return Lexer
     */
    private function configureKeywords(): Lexer
    {
        return new Lexer(
            new ArrayKeywords(
                [
                    'en' => [
                        'feature'          => 'Feature',
                        'background'       => 'Background',
                        'scenario'         => 'Scenario',
                        'scenario_outline' => 'Scenario Outline|Scenario Template',
                        'examples'         => 'Examples|Scenarios',
                        'given'            => 'Given',
                        'when'             => 'When',
                        'then'             => 'Then',
                        'and'              => 'And',
                        'but'              => 'But'
                    ]
                ]
            )
        );
    }
}
