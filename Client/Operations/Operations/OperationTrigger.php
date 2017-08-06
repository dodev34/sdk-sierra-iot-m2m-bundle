<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\Operation;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class OperationTrigger
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\Operation
 */
class OperationTrigger extends SierraClient
{
    /**
     * Retrieve all the triggers of a company.
     *
     * @param array $query
     * @return string
     */
    public function retrieveAllTriggers(array $query = [])
    {
        $response = $this->request('GET', '/operations/triggers', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Get the trigger identified by the given uid.
     *
     * @param string $uid
     * @param array $query
     * @return string
     */
    public function getTriggerDetails($uid, array $query = [])
    {
        $response = $this->request('GET', '/operations/triggers/'.$uid, ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Create a new trigger.
     *
     * @param array $query
     * @return string
     */
    public function createANewTrigger(array $query = [])
    {
        $response = $this->request('GET', '/operations/triggers', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }
}