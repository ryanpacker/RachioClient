<?php
namespace Rpacker\RachioClient\Entity;

class Person
{
    private $id;
    private $username;
    private $fullName;
    private $email;
    private $devices;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->fullName = $data['fullName'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->devices = array_map(function ($deviceData) {
            return new Device($deviceData);
        }, $data['devices'] ?? []);
    }

    public function getDeviceIds()
    {
        return array_map(function ($device) {
            return $device->getId();
        }, $this->devices);
    }

    public function getEnabledZones()
    {
        $enabledZones = [];
        foreach ($this->devices as $device) {
            if ($device->getStatus() === "ONLINE") {
                foreach ($device->getZones() as $zone) {
                    if ($zone->isEnabled()) {
                        $enabledZones[] = $zone;
                    }
                }
            }
        }
        return $enabledZones;
    }
}
