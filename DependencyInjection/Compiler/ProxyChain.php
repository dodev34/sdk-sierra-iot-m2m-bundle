<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\ClientInterface;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\ClientExceptionProvider;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\TokenProvider;

/**
 * Class ProxyChain
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler
 */
class ProxyChain
{
    /**
     * @var array of ClientInterface
     */
    protected $proxis;

    /**
     * Chain constructor.
     */
    public function __construct()
    {
        $this->proxis = array();
    }

    /**
     * @param ClientInterface $client
     * @param $baseClient
     * @param TokenProvider $tokenProvider
     * @param null $alias
     * @return $this
     */
    public function addProxy(ClientInterface $client, $baseClient, TokenProvider $tokenProvider, ClientExceptionProvider $clientExceptionProvider, $alias = null)
    {
        /** @var string $key */
        $key = is_null($alias) ? get_class($client) : $alias;
        $client->setClient($baseClient);
        $client->setTokenProvider($tokenProvider);
        $client->setExceptionProvider($clientExceptionProvider);
        $this->proxis[$key] = $client;

        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getProxy($name)
    {
        if (array_key_exists($name, $this->proxis)) {
            return $this->proxis[$name];
        }
    }
}