#!/usr/bin/php
<?php declare(strict_types=1);

use Criterja\App;
use Criterja\cli\CriterjaCli;
use League\CLImate\CLImate;

/**
*                 __________            ________        
*    ________________(_)_  /__________________(_)_____ _
*    _  ___/_  ___/_  /_  __/  _ \_  ___/____  /_  __ `/
*    / /__ _  /   _  / / /_ /  __/  /   ____  / / /_/ / 
*    \___/ /_/    /_/  \__/ \___//_/    ___  /  \__,_/  
*                                       /___/           
*/

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
error_reporting(0);

$cli = new CriterjaCli(
    new CLImate(),
    new App()
);
$cli->run();