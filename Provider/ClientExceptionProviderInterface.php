<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider;

/**
 * Class ClientExceptionProviderInterface
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider
 */
interface ClientExceptionProviderInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    public function getException($name);
}