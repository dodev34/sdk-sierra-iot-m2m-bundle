<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Data
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System
 */
class Data extends SierraClient
{
    /**
     * Get the last datapoints of the system matching the unique identifier of data defined in the url.
     * If no data identifier is set, the last datapoint for all data will be retrieved.
     *
     * @param string $uid
     * @param array $json
     * @return string
     */
    public function lastDatapoints($uid, array $json = [])
    {
        $response = $this->request('GET', '/systems/'.$uid.'/data', ['json' => $json]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Get the historical values of a raw data for a selection of systems and a list of data id defined in the url.
     * Most recent datapoints are returned first.
     *
     * @param array $query
     * @return string
     */
    public function multiRawDatapoints(array $query = [])
    {
        $response = $this->request('GET', '/systems/data/raw', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Get a temporal aggregation of data points for a selection of systems identified by a list of unique identifiers
     * and a list of data ids in the url.
     * Most recent datapoints are returned first.
     *
     * @param array $query
     * @return string
     */
    public function multiAggregatedDatapoints(array $query = [])
    {
        $response = $this->request('GET', '/systems/data/aggregated', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Get a temporal aggregation of data points for a fleet of systems identified by a list of company identifier
     * and a list of data id in the url.
     * Most recent datapoints are returned first.
     *
     * @param array $query
     * @return string
     */
    public function fleetAggregatedDatapoints(array $query = [])
    {
        $response = $this->request('GET', '/systems/data/fleet', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Export the historical data of one system to a CSV file.
     *
     * @param string $uid
     * @return string
     */
    public function exportDatapoints($uid)
    {
        $response = $this->request('POST', '/operations/systems/'.$uid.'/export/data/historical');

        return (string) $response->getBody()->getContents();
    }

    /**
     * @param array $options
     */
    public function importUsages(array $options = [])
    {
        throw new \RuntimeException("not implemented");
    }

    /**
     * Get list of data usage records for the given system. Most recent records are returned first.
     *
     * @param string $uid
     * @param array $query
     * @return string
     */
    public function usageRecords($uid, array $query = [])
    {
        $response = $this->request('GET', '/systems/'.$uid.'/usages/records', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    public function multiUsageRecords(array $query = [])
    {
        $response = $this->request('GET', '/systems/usages/records', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    public function detailsOfAUsageRecord()
    {

    }
}