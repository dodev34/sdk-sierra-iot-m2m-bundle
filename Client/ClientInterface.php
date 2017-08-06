<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client;

use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\ClientExceptionProviderInterface;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\TokenProvider;

/**
 * Interface ServiceInterface
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client
 */
interface ClientInterface extends GuzzleHttpClientInterface
{
    /** @version number */
    const SDK_VERSION = 1;

    /**
     * @param $baseUri
     */
    public function setBaseUri($baseUri);

    /**
     * @return mixed
     */
    public function getBaseUri();

    /**
     * @param $client
     */
    public function setClient($client);

    /**
     * @return mixed
     */
    public function getClient();

    /**
     * @return TokenProvider
     */
    public function getTokenProvider();

    /**
     * @param TokenProvider $tokenProvider
     */
    public function setTokenProvider(TokenProvider $tokenProvider);

    /**
     * @param ClientExceptionProviderInterface $exceptionProvider
     */
    public function setExceptionProvider(ClientExceptionProviderInterface $exceptionProvider);

    /**
     * @return ClientExceptionProviderInterface
     */
    public function getExceptionProvider();
}