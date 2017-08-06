<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider;


interface TokenProviderInterface
{
    /**
     * @return mixed {"access_token":"xx","token_type":"Bearer","refresh_token":"xx","expires_in":86399}
     */
    public function getToken();

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