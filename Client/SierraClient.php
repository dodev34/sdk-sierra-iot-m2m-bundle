<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Exception\ClientException;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Exception\ClientException as M12USierraClientException;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\ClientExceptionProviderInterface;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\TokenProvider;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Exception;

/**
 * Class SierraService
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client
 */
class SierraClient implements ClientInterface
{
    /**
     *
     */
    const BASE_URI = "/api/v1";

    /**
     * @var TokenProvider
     */
    protected $tokenProvider;

    /**
     * @var ClientExceptionProviderInterface
     */
    protected $exceptionProvider;

    /**
     * @var
     */
    protected $baseUri;

    /**
     * @var
     */
    protected $client;

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->getTokenProvider()->getToken();
    }

    /**
     * @return TokenProvider
     */
    public function getTokenProvider()
    {
        return $this->tokenProvider;
    }

    /**
     * @param TokenProvider $tokenProvider
     */
    public function setTokenProvider(TokenProvider $tokenProvider)
    {
        $this->tokenProvider = $tokenProvider;
    }

    /**
     * @param $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return mixed
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientExceptionProviderInterface $exceptionProvider
     */
    public function setExceptionProvider(ClientExceptionProviderInterface $exceptionProvider)
    {
        $this->exceptionProvider = $exceptionProvider;
    }

    /**
     * @return ClientExceptionProviderInterface
     */
    public function getExceptionProvider()
    {
        return $this->exceptionProvider;
    }

    /**
     * Send an HTTP request.
     *
     * @param RequestInterface $request Request to send
     * @param array $options Request options to apply to the given
     *                                  request and to the transfer.
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function send(RequestInterface $request, array $options = [])
    {
        // TODO: Implement send() method.
    }

    /**
     * Asynchronously send an HTTP request.
     *
     * @param RequestInterface $request Request to send
     * @param array $options Request options to apply to the given
     *                                  request and to the transfer.
     *
     * @return PromiseInterface
     */
    public function sendAsync(RequestInterface $request, array $options = [])
    {
        // TODO: Implement sendAsync() method.
    }

    /**
     * Create and send an HTTP request.
     *
     * Use an absolute path to override the base path of the client, or a
     * relative path to append to the base path of the client. The URL can
     * contain the query string as well.
     *
     * @param string $method HTTP method.
     * @param string|UriInterface $uri URI object or string.
     * @param array $options Request options to apply.

     * @return mixed
     * @throws M12USierraClientException
     */
    public function request($method, $uri, array $options = [])
    {
        $options = array_merge(
            ['headers' => ['Authorization' => "Bearer ".$this->getAccessToken()]],
            $options
        );

        try {
            $response = $this->getClient()->request(
                $method,
                static::BASE_URI . $uri,
                $options
            );

            return $response;
        } catch (ClientException $e) {
            $message = $e->getMessage();
            $message = explode("\n", $message);
            $jsonError = json_decode($message[1]);
            $throw = $this->exceptionProvider->getException($jsonError->error);
            if (!($throw instanceof M12USierraClientException)) {
                throw new M12USierraClientException($e->getMessage(), $e->getCode(), $e);
            }
            $throw->setCode($e->getCode())->setMessage($message[0]);
            throw $throw;
        } catch (Exception $e) {
            throw new M12USierraClientException($e->getMessage(), $e->getCode(), $e);
        }

    }

    /**
     * Create and send an asynchronous HTTP request.
     *
     * Use an absolute path to override the base path of the client, or a
     * relative path to append to the base path of the client. The URL can
     * contain the query string as well. Use an array to provide a URL
     * template and additional variables to use in the URL template expansion.
     *
     * @param string $method HTTP method
     * @param string|UriInterface $uri URI object or string.
     * @param array $options Request options to apply.
     *
     * @return PromiseInterface
     */
    public function requestAsync($method, $uri, array $options = [])
    {
        // TODO: Implement requestAsync() method.
    }

    /**
     * Get a client configuration option.
     *
     * These options include default request options of the client, a "handler"
     * (if utilized by the concrete client), and a "base_uri" if utilized by
     * the concrete client.
     *
     * @param string|null $option The config option to retrieve.
     *
     * @return mixed
     */
    public function getConfig($option = null)
    {
        // TODO: Implement getConfig() method.
    }
}