<?php
namespace Rpacker\RachioClient\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Rpacker\RachioClient\Entity\Person;
use Rpacker\RachioClient\Entity\Device;

class RachioClient
{
    private $client;
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api.rach.io/1/public/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);
    }

    public function getPersonId()
    {
        try {
            $response = $this->client->get("person/info");
            $data = json_decode($response->getBody(), true);
            
            if (isset($data['id'])) {
                return $data['id'];
            } else {
                throw new \Exception('No ID found in the response');
            }
        } catch (RequestException $e) {
            return 'Error: ' . $e->getMessage();
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getPerson(string $personId)
    {
        $response = $this->client->get("person/$personId");
        return new Person(json_decode($response->getBody(), true));
    }

    public function getDevice(string $deviceId)
    {
        $response = $this->client->get("device/$deviceId");
        return new Device(json_decode($response->getBody(), true));
    }
}
