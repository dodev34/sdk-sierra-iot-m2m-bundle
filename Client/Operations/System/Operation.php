<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class System
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System
 */
class Operation extends SierraClient
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
    public function details($uid)
    {
        $response = $this->request('GET', '/operations/'.$uid);

        return (string) $response->getBody()->getContents();
    }
}