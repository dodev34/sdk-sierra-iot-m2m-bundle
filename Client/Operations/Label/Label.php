<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\Label;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Label
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\Label
 */
class Label extends SierraClient
{
    /**
     * Returns the list of existing labels for this company.
     * It is possible to restrain results using criteria
     *
     * @param array $query
     * @return string
     */
    public function find(array $query = [])
    {
        $response = $this->request('GET', '/labels', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Creates a new label for the context company.
     *
     * @param array $query
     * @return string
     */
    public function create(array $query = [])
    {
        $response = $this->request('POST', '/labels', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Delete a label matching the specified name for the context company.
     *
     * @param string $name
     * @param array $query
     * @return string
     */
    public function delete($name, array $query = [])
    {
        $response = $this->request('POST', '/labels/'.$name, ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }
}