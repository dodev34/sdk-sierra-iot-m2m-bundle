<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Administration;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\SierraClient;

/**
 * Class Company
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Administration
 */
class Company extends SierraClient
{
    /**
     * Returns detailed information about the specified company.
     *
     * @param array $query
     * @return string
     */
    public function getDetails(array $query = [])
    {
        $response = $this->request('GET', '/company', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Edit details of a company. Only name, address, ipFiltering, ipFilters,
     * deviceIpFiltering and deviceIpFilters fields can be updated.
     *
     * @param array $query
     * @return string
     */
    public function edit(array $query = [])
    {
        $response = $this->request('PUT', '/company', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Get the administrators of the given company.
     *
     * @param int $companyUid
     * @param array $query
     * @return string
     */
    public function getAdministrators($companyUid, array $query = [])
    {
        $response = $this->request('GET', '/company/'.$companyUid.'/administrators', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Set a new list of administrators of a specific company.
     * In other words, if you want to add a user to the exisiting list of administrator,
     * then you have to send this list extended with the uid of the new user.
     * Notices that it is not possible to send an empty list.
     * At least one administrator must be set.
     *
     * @param int $companyUid
     * @param array $query
     * @return string
     */
    public function editAdministrators($companyUid, array $query = [])
    {
        $response = $this->request('PUT', '/company/'.$companyUid.'/administrators', ['query' => $query]);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Get the company image in a specific size: original size, thumbnail size, or icon size.
     *
     * @param int $uid
     * @param string $name
     * @return string
     */
    public function getPicture($uid, $name)
    {
        $response = $this->request('PUT', '/company/'.$uid.'/picture/'.$name);

        return (string) $response->getBody()->getContents();
    }

    /**
     * Upload an image. The service creates 3 images in the file store for the uploaded one.
     * Uploaded images cannot be bigger than 750KB and dimensions have to be equals or less than 1024 px per side.
     *
     * @param int $uid
     * @param array $options
     * @return string
     */
    public function uploadPicture($uid, array $options = [])
    {
        $response = $this->request('POST', '/company/'.$uid.'/picture', $options);

        return (string) $response->getBody()->getContents();
    }
}