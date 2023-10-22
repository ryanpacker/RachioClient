<?php

require 'vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

// overly complex loading of YAML config file to allow for extensibility
$locator = new FileLocator(dirname(__DIR__) . '/config') ;
$yamlConfigFile = $locator->locate('rachio_client.yaml', null, true);
$configValues = Yaml::parse(file_get_contents($yamlConfigFile));