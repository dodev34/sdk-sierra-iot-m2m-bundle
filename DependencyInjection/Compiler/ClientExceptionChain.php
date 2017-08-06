<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler;

use Throwable;

/**
 * Class ClientExceptionChain
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler
 */
class ClientExceptionChain
{
    /**
     * @var array of ClientInterface
     */
    protected $clientException;

    /**
     * Chain constructor.
     */
    public function __construct()
    {
        $this->clientException = array();
    }

    /**
     * @param Throwable $throwable
     * @param string $alias
     * @return $this
     */
    public function addClientException(Throwable $throwable, $alias)
    {
        /** @var string $key */
        $key = $alias;
        $this->clientException[$key] = $throwable;

        return $this;
    }

    /**
     * @param string $name
     * @return Throwable
     */
    public function getClientException($name)
    {
        if (array_key_exists($name, $this->clientException)) {
            return $this->clientException[$name];
        }
    }
}