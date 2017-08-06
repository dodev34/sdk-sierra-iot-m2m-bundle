<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\Operation;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Operation
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\Operation
 */
class Operation extends SierraClient
{
    /**
     * Returns a paginated list of operations with their complete details sorted by startDate descending.
     * It is possible to restrain the result list using criteria parameters.
     * The fields parameter has to be defined in order to specify the attributes of the operation which will be returned.
     * If fields parameter is missing, only the following attributes of the operation are returned:
     * uid, state, category, entity, type, operationType, createdAt, startDate, endDate, timeoutDate, cancelDate.
     *
     * @param array $query
     * @return string
     */
    public function find(array $query = [])
    {
        $response = $this->request('GET', '/operations', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Get the details of an operation.
     *
     * @param string $uid
     * @return string
     */
    public function details($uid)
    {
        $response = $this->request('GET', '/operations/' . $uid);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Returns, for an operation, a paginated list of tasks with their complete details sorted by rank.
     * It is possible to restrain the result list using criteria parameters.
     * The fields parameter has to be defined in order to specify the attributes of the operation which will be returned.
     * If fields parameter is missing, only the following attributes of the operation are returned:
     * uid, date, rank, state, target.
     *
     * @param string $uid
     * @param array $query
     * @return string
     */
    public function getTasks($uid, array $query = [])
    {
        $response = $this->request('GET', '/operations/' . $uid . '/tasks', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Get the details of a task owned by an operation.
     *
     * @param string $operationUid
     * @param string $taskUid
     * @return string
     */
    public function getTheDetailsOfATask($operationUid, $taskUid)
    {
        $response = $this->request('GET', '/operations/'.$operationUid.'/tasks/'.$taskUid);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Returns a complete report of an operation.
     * It contains more information about the operation's execution like message errors, files exchanged, etc.
     *
     * @deprecated API: use Get operation details and Get tasks
     * @param string $uid
     * @param array $query
     * @return string
     */
    public function getReport($uid, array $query = [])
    {
        $response = $this->request('GET', '/operations/'.$uid.'/report', ['query' => $query]);

        return (string)$response->getBody()->getContents();
    }

    /**
     * Returns the generated file in case this operation was in charge to export some data.
     *
     * @param $uid
     * @return string
     */
    public function getResult($uid)
    {
        $response = $this->request('GET', '/operations/'.$uid.'/result');

        return (string)$response->getBody()->getContents();
    }

    /**
     * Cancel a specific operation.
     * All tasks which are not terminated will be cancelled.
     * The operation will be finished when all its tasks will be terminated (SUCCESS, FAILURE or CANCELLED).
     *
     * @param $uid
     * @return string
     */
    public function cancel($uid)
    {
        $response = $this->request('GET', '/operations/'.$uid.'/cancel');

        return (string)$response->getBody()->getContents();
    }
}