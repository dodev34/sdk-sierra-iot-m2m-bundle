<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Communication
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System
 */
class Communication extends SierraClient
{
    /**
     * Apply a list of settings on a set of systems defined by a label or a list of uid.
     *
     * @param array $json
     * @return string
     */
    public function applySettings(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/settings', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Retrieve data from a set of systems defined by a label or a list of uids.
     *
     * @param array $json
     * @return string
     */
    public function retrieveData(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/data/retrieve', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Send a command to a set of systems defined by a label or a list of uid.
     *
     * @param array $json
     * @return string
     */
    public function applicativeCommand(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/data/retrieve', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Send a text SMS to a selection of systems.
     *
     * @param array $json
     * @return string
     */
    public function textSMS(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/sms', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }
}