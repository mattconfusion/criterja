<?php declare(strict_types=1);

namespace Criterja\cli;

use \League\CLImate\CLImate;
use Criterja\App;
use Criterja\formatter\FormatType;
use Criterja\utils\WriteErrorException;
use League\CLImate\Exceptions\InvalidArgumentException;
use phpDocumentor\Reflection\Types\Boolean;

class CriterjaCli
{

    const OUTPUT_MARKDOWN = 'markdown';
    const OUTPUT_HTML = 'html';

    private $cli;
    private $app;
    private $availableFormats = [
        self::OUTPUT_HTML,
        self::OUTPUT_MARKDOWN
    ];

    /**
     * Constructs the Criterja CLI
     *
     * @param CLImate $cli
     */
    public function __construct(CLImate $cli, App $app)
    {
        $this->cli = $cli;
        $this->app = $app;

        // configure CLI
        $this->cli->forceAnsiOn();
        $this->cli->description("Criterja. Converts your Acceptance Criteria in some Accepted Formats.");
        $this->cli->addArt(__DIR__ . DIRECTORY_SEPARATOR);

        $this->cli->arguments->add([
            'path' => [
                'description'  => 'Gherkin .feature file',
                'required'     => true,
            ],
            'output' => [
                'prefix'       => 'o',
                'longPrefix'   => 'output',
                'description'  => 'Output format, either ' . self::OUTPUT_MARKDOWN . ' or ' . self::OUTPUT_HTML,
                'defaultValue' => self::OUTPUT_MARKDOWN
            ],
            'update on jira' => [
                'prefix'       => 'j',
                'longPrefix'   => 'jiraupdate',
                'description'  => 'Send the gherkin to a specified field in an existing issue in Jira',
                'defaultValue' => "false",
                'castTo' => 'bool'
            ],
            'help' => [
                'prefix'       => 'h',
                'longPrefix'   => 'help',
                'description'  => 'Shows help'
            ]
        ]);
    }

    /**
     * Run the CLI application
     *
     * @return void
     */
    public function run()
    {
        try {
            //draw title
            $this->cli->br()->blue()->draw('title');

            //parse args
            $this->cli->arguments->parse();

            // show help
            if ($this->cli->arguments->get('help')) {
                $this->cli->br()->br()->usage();
            }

            $output = $this->getOutputFormat(
                $this->cli->arguments->get('output')
            );

            //start the thing
            $results = $this->app->run(
                $this->cli->arguments->get('path'),
                $output
            );

            //output results
            $this->cli->br()->green()->out(\sprintf(
                '%s converted to file %s',
                $this->cli->arguments->get('path'),
                $results
            ));

        } catch (CliException $ex) {
            $this->cli->br()->error($ex->getMessage());
        } catch (InvalidArgumentException $ex) {
            $this->cli->br()->error($ex->getMessage());
            $this->cli->br()->br()->usage();
        } catch (WriteErrorException $ex) {
            $this->cli->br()->shout(
                \sprintf(
                    'Error while writing file: %s',
                    $ex->getMessage()
                )
            );
        } catch (\Exception $ex) {
            $this->cli->br()->shout(
                \sprintf(
                    'An error occured: %s',
                    $ex->getMessage()
                )
            );
        }
    }

    /**
     * Returns the output format, validating it
     *
     * @param string $format
     * @return string
     */
    private function getOutputFormat(string $format): FormatType
    {
        if (!\in_array($format, $this->availableFormats)) {
            throw new CliException(\sprintf('%s is not a valid output format', $format));
        }

        return $this->getFormatType($format);
    }

    /**
     * Get the format type from the parameter passed via CLI argument
     *
     * @param string $outputFormat
     * @return FormatType
     */
    private function getFormatType(string $outputFormat): FormatType
    {
        switch ($outputFormat) {
            case self::OUTPUT_MARKDOWN:
                return FormatType::MARKDOWN();
            case self::OUTPUT_HTML:
                return FormatType::HTML();
        }
    }
}
