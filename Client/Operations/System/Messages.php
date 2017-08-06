<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Messages
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System
 */
class Messages extends SierraClient
{
    /**
     * Retrieve the list of past messages. The uid, timestamp, protocol and datapoints count are retrieved.
     * Duplicate data are counted.
     *
     * @param $uid
     * @param array $query
     * @return string
     */
    public function listOfMessages($uid, array $query = [])
    {
        $response = $this->request('GET', '/systems/'.$uid.'/messages', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * @param string $uidSystem
     * @param string $uidMessage
     * @return string
     */
    public function detailsOfAMessage($uidSystem, $uidMessage)
    {
        $response = $this->request('GET', '/systems/'.$uidSystem.'/messages/'.$uidMessage);

        return (string) $response->getBody()->getContents();
    }
}