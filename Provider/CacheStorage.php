<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider;

/**
 * Class CacheStorage
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider
 */
class CacheStorage implements TokenStorageInterface
{
    /**
     * @var string
     */
    protected $cacheDir;

    /**
     * @var string
     */
    protected $tokenFileName;

    /**
     * TokenStorage constructor.
     * @param $cacheDir
     */
    public function __construct($cacheDir, $tokenFileName = 'm12u_sierra_token.json')
    {
        $this->cacheDir = $cacheDir;
        $this->tokenFileName = $tokenFileName;
    }

    /**
     * @param \stdClass $token
     */
    public function store($token)
    {
        if( !file_put_contents($this->cacheDir . '/' . $this->tokenFileName, json_encode($token))) {
            throw new \RuntimeException("Unabled to store token");
        }
    }

    /**
     * @return mixed
     */
    public function retrieve()
    {
        if( !$token = file_get_contents($this->cacheDir . '/' . $this->tokenFileName)) {
            throw new \RuntimeException("Unabled to retrieve token");
        }

        return json_decode($token);
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        return (bool)file_exists($this->cacheDir . '/' . $this->tokenFileName);
    }
}