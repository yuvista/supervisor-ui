<?php

namespace Supervisor\Service;

use Supervisor\Supervisor;
use Supervisor\Connector\XmlRpc;
use fXmlRpc\Client;
use fXmlRpc\Transport\Guzzle4Bridge;

/**
 * Class SupervisorClient
 * @package Supervisor\Service
 * @author Sander Krause <sanderkrause@gmail.com>
 */
class SupervisorClient
{
    /**
     * @var array Internal list of all Supervisor instances.
     */
    protected $instances = [];

    /**
     * Constructor for SupervisorClient, accepting a configuration array.
     * @param array $config
     */
    public function __construct(array $config) {
        foreach ($config['instances'] as $name => $instanceConfig) {
            $this->addInstance(
                $name,
                $instanceConfig['host'],
                $instanceConfig['port'],
                isset($instanceConfig['user']) ? $instanceConfig['user'] : null,
                isset($instanceConfig['password']) ? $instanceConfig['password'] : null
            );
        }
    }

    /**
     * Add a named Supervisor instance, if it does not already exist.
     * @param string $name
     * @param string $host
     * @param int $port
     * @param string|null $userName
     * @param string|null $password
     * @return SupervisorClient
     */
    public function addInstance($name, $host, $port, $userName = null, $password = null) {

        if (!array_key_exists($name, $this->instances)) {
            $client = new Client(
                "http://$host:$port/RPC2",
                new Guzzle4Bridge(new \GuzzleHttp\Client(['defaults' => ['auth' => [$userName, $password]]]))
            );
            // Pass the client to the connector
            // See the full list of connectors bellow
            $connector = new XmlRpc($client);
            $supervisor = new Supervisor($connector);
            $this->instances[$name] = $supervisor;
        }

        return $this;
    }

    /**
     * Returns the named Supervisor instance, if it exists. Otherwise, return null instead.
     * @param $name
     * @return Supervisor|null
     */
    public function getInstance($name = 'default') {
       return isset($this->instances[$name]) ? $this->instances[$name] : null;
    }

    /**
     * Returns all Supervisor instances.
     * @return array
     */
    public function getInstances() {
        return $this->instances;
    }
}