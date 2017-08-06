<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider;


interface TokenStorageInterface
{
    /**
     * @param \stdClass $token
     */
    public function store($token);

    /**
     * @return mixed
     */
    public function retrieve();

    /**
     * @return bool
     */
    public function hasToken();
}