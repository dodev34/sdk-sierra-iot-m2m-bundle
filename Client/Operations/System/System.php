<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class System
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System
 */
class System extends SierraClient
{
    /**
     * Returns a paginated list of systems with their complete details.
     * It is possible to filter out the result list using criteria parameters.
     * Returned systems are shown only with the following attributes
     * uid, name, state, type, lifeCycleState, activityState, creationDate, activationDate, lastStateChangeDate,
     * lastCommDate, commStatus, lastSyncDate, syncStatus To display more or less attributes,
     * the fields parameter has to be set.
     * Though system creation date is not publicly exposed, the default sort order is based on the creation date.
     *
     * @param array $query
     * @return string
     */
    public function find(array $query = [])
    {
        $response = $this->request('GET', '/systems', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Create a single system from scratch. For the associated gateway and the subscription, you can either
     * create a new one on the fly or select an existing one by its uid.
     *
     * @param array $json
     * @param array $query
     * @return string
     */
    public function create(array $json = [], array $query = [])
    {
        $response = $this->request('POST', '/systems', ['json' => $json, 'query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Edit the system identified by the uid of the request.
     *
     * @param string $uid
     * @param array $json
     * @return string
     */
    public function edit($uid, array $json = [])
    {
        $response = $this->request('PUT', '/systems/'.$uid, ['json' => $json]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Delete a specific system from AirVantage.
     * If needed, the user can delete the gateway and the subscription linked to the system.
     *
     * @param string $uid
     * @param array $query
     * @return string
     */
    public function delete($uid, array $query = [])
    {
        $response = $this->request('DELETE', '/systems/'.$uid, ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Returns detailed information about the specified system.
     *
     * @param string $uid
     * @return string
     */
    public function details($uid)
    {
        $response = $this->request('GET', '/systems/'.$uid);

        return (string)$response->getBody()->getContents();
    }


    /**
     * Returns the options of the specified system.
     *
     * @param string $uid
     * @return string
     */
    public function getOptions($uid)
    {
        $response = $this->request('GET', 'systems/'.$uid.'/data');

        return (string)$response->getBody()->getContents();
    }
}