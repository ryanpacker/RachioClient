<?php
require dirname(__DIR__) . '/config/bootstrap.php';

use Rpacker\RachioClient\Service\RachioClient;

$apiKey         = $configValues['rachio_api_key'];
$purgeTime      = $configValues['purge_time'];
$rechargeTime   = $configValues['recharge_time'];
$cycles         = $configValues['cycles'] ?? 6;

$rachioClient = new RachioClient($apiKey);
$personId = $rachioClient->getPersonId();

$person = $rachioClient->getPerson($personId);
$enabledZones = $person->getEnabledZones();

for($i = 1; $i <= $cycles; $i++){
    echo "[" . date('Y-m-d H:i:s') . "] Starting cycle {$i} of {$cycles}" . PHP_EOL;
    foreach($enabledZones as $zone){
        echo "[" . date('Y-m-d H:i:s') . "] Purging {$zone->getName()} for {$purgeTime} seconds" . PHP_EOL;    
        $rachioClient->startZone($zone->getID(), $purgeTime);

        sleep($purgeTime);

        echo "[" . date('Y-m-d H:i:s') . "] Waiting for compressor to recharge for {$rechargeTime} seconds" . PHP_EOL;
        sleep($rechargeTime);
    }
}
