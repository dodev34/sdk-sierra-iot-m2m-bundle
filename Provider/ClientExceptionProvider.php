<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler\ClientExceptionChain;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler\ProxyChain;

use InvalidArgumentException;

/**
 * Class ClientExceptionProvider
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider
 */
class ClientExceptionProvider implements ClientExceptionProviderInterface
{
    /**
     * @var ClientExceptionChain
     */
    protected $chain;

    /**
     * ClientExceptionProvider constructor.
     * @param ClientExceptionChain $chain
     */
    public function __construct(ClientExceptionChain $chain)
    {
        $this->chain = $chain;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getException($name)
    {
        if (!$proxy = $this->chain->getClientException($name)) {
            throw new InvalidArgumentException(sprintf(
                "Client exception '%s' doesn't exist.", $name));
        }

        return $proxy;
    }
}