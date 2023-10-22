<?php
namespace Rpacker\RachioClient\Entity;

class Zone
{
    private $id;
    private $name;
    private $enabled;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->enabled = $data['enabled'] ?? null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }
}
