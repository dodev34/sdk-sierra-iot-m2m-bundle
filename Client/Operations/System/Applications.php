<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Applications
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System
 */
class Applications extends SierraClient
{
    /**
     * Install or upgrade an application on a set of systems defined by a label or a list of uids.
     *
     * @param array $json
     * @return string
     */
    public function installApplication(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/applications/install', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Uninstall an application on a set of systems defined by a label or a list of uids.
     *
     * @param array $json
     * @return string
     */
    public function uninstallApplication(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/applications/uninstall', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Start an application on a set of systems defined by a label or a list of uids.
     *
     * @param array $json
     * @return string
     */
    public function startApplication(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/applications/start', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Stop an application on a set of systems defined by a label or a list of uids.
     *
     * @param array $json
     * @return string
     */
    public function stopApplication(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/applications/stop', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    public function systemConfiguration(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/updatecfg', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }
}