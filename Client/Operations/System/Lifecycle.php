<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Lifecycle
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System
 */
class Lifecycle  extends SierraClient
{
    /**
     * Activate a selection of systems.
     * If possible, the susbcription linked to the system will be activated.
     * Upon activation success, the lifecycle state of the system will be ACTIVE or TEST_READY.
     *
     * @param array $json
     * @return string
     */
    public function activate(array $json =[])
    {
        $response = $this->request('POST', '/operations/systems/activate', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Suspend a selection of systems.
     * If possible, the susbcription linked to the system will be suspended.
     * Upon suspension success, the lifecycle state of the system will be SUSPENDED.
     *
     * @param array $json
     * @return string
     */
    public function suspend(array $json =[])
    {
        $response = $this->request('POST', '/operations/systems/suspend', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Resume a selection of systems.
     * If possible, the susbcription linked to the system will be resumed.
     * Upon resume success, the lifecycle state of the system will be ACTIVE or TEST_READY.
     *
     * @param array $json
     * @return string
     */
    public function resume(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/resume', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Terminate a selection of systems.
     * If possible, the susbcription linked to the system will be terminated.Upon terminate success,
     * the lifecycle state of the system will be RETIRED.
     *
     * @param array $json
     * @return string
     */
    public function terminate(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/terminate', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Change the offer on a selection of systems.
     *
     * @param array $json
     * @return string
     */
    public function changeOffer(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/changeoffer', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Change the options on a selection of systems.
     *
     * @param array $json
     * @return string
     */
    public function changeOptions(array $json = [])
    {
        $response = $this->request('POST', '/operations/systems/changeoptions', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Detach from the network a selection of systems.
     * This operation is only possible on systems linked to a SIERRA WIRELESS subscription.
     *
     * @param array $json
     * @return string
     */
    public function networkDetach(array $json =[])
    {
        $response = $this->request('POST', '/operations/systems/network/detach', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Get the network status of a selection of systems.
     * This operation is only possible on systems linked to a SIERRA WIRELESS subscription.
     * For each selected system, the network information are available in the details of the associated task.
     * Below a sample of the returned network information:
     *
     * @param array $json
     * @return string
     */
    public function networkStatus(array $json =[])
    {
        $response = $this->request('POST', '/operations/systems/network/status', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Swap SIM between two systems.
     * Returns the uid of the created operation.
     *
     * @param array $json
     * @return string
     */
    public function swapSIM(array $json =[])
    {
        $response = $this->request('POST', '/operations/systems/swapsim', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }
}