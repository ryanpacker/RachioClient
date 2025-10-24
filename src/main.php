<?php
require dirname(__DIR__) . '/config/bootstrap.php';

use Rpacker\RachioClient\Service\RachioClient;

$apiKey         = $configValues['rachio_api_key'];
$purgeTime      = $configValues['purge_time'];
$rechargeTime   = $configValues['recharge_time'];

$rachioClient = new RachioClient($apiKey);
$personId = $rachioClient->getPersonId();

$person = $rachioClient->getPerson($personId);
$enabledZones = $person->getEnabledZones();

foreach($enabledZones as $zone){
    echo "[" . date('Y-m-d H:i:s') . "] Purging {$zone->getName()} for {$purgeTime} seconds" . PHP_EOL;    
    $rachioClient->startZone($zone->getID(), $purgeTime);

    // wait for zone to finish
    sleep($purgeTime);

    // wait for compressor to recharge
    echo "[" . date('Y-m-d H:i:s') . "] Waiting for compressor to recharge for {$rechargeTime} seconds" . PHP_EOL;
    sleep($rechargeTime);
}
