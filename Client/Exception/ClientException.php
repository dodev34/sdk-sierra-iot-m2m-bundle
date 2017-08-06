<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Exception;

use Exception;

/**
 * Class ClientException
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Exception
 */
class ClientException extends Exception
{
    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}