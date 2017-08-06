<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\OfferAndOptions;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Offer
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\OfferAndOptions
 */
class Offer extends SierraClient
{
    /**
     * Returns a list of available offers
     *
     * @param array $query
     * @return string
     */
    public function find(array $query = [])
    {
        $response = $this->request('GET', '/offers', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Returns the options of the specified offer
     *
     * @param string $uid
     * @param array $query
     * @return string
     */
    public function getOptionsOfAnOffer($uid, array $query = [])
    {
        $response = $this->request('GET', '/offers/'.$uid.'/options', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Returns a list of available options
     *
     * @param array $query
     * @return string
     */
    public function findAvailableOptions(array $query = [])
    {
        $response = $this->request('GET', '/offers/options', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }
}