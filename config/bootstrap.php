<?php

require 'vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

// overly complex loading of YAML config file to allow for extensibility
$configDir = dirname(__DIR__) . '/config';
$locator = new FileLocator($configDir) ;
$localConfig = 'rachio_client.local.yaml';
$defaultConfig = 'rachio_client.yaml';
$targetConfig = file_exists($configDir . '/' . $localConfig) ? $localConfig : $defaultConfig;
$yamlConfigFile = $locator->locate($targetConfig, null, true);
$configValues = Yaml::parse(file_get_contents($yamlConfigFile));