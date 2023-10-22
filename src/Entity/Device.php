<?php
namespace Rpacker\RachioClient\Entity;

class Device
{
    private $id;
    private $status;
    private $zones;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->zones = array_map(function ($zoneData) {
            return new Zone($zoneData);
        }, $data['zones'] ?? []);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getZones()
    {
        return $this->zones;
    }
}
