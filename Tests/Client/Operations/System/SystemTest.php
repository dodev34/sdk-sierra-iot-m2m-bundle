<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Tests\Operations\System;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System\System;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\TokenProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class SystemTest
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Tests\Operations\System
 *
 * @see https://doc.airvantage.net/av/reference/cloud/API/API-System-v1/
 */
class SystemTest extends TestCase
{
    /**
     * @var Mock
     */
    protected $stream;
    protected $response;
    protected $guzzle;
    protected $tokenProvider;

    protected function setUp()
    {
        $this->stream = $this->getMockBuilder(Stream::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->stream->method('getContents')
            ->willReturn('{"mock":"fake response"}');

        $this->response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->response->method('getBody')
            ->willReturn($this->stream);

        $this->guzzle = $this->createMock(GuzzleHttpClient::class);
        $this->guzzle->method('request')->willReturn($this->response);

        $this->tokenProvider = $this->getMockBuilder(TokenProvider::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->tokenProvider->method('getToken')
            ->willReturn('123456789');
    }

    public function testFind()
    {
        $client = new System();
        $client->setClient($this->guzzle);
        $client->setTokenProvider($this->tokenProvider);

        $response = $client->find();
        $this->assertTrue(is_string($response));

        $response = $client->find(['company' => '1234']);
        $this->assertTrue(is_string($response));
    }

    public function testCreate()
    {
        $client = new System();
        $client->setClient($this->guzzle);
        $client->setTokenProvider($this->tokenProvider);

        $response = $client->create(['name' => 'My Test']);
        $this->assertTrue(is_string($response));
    }

    public function testEdit()
    {
        $client = new System();
        $client->setClient($this->guzzle);
        $client->setTokenProvider($this->tokenProvider);

        $response = $client->edit('1234567890');
        $this->assertTrue(is_string($response));

        $response = $client->edit('1234567890', ['company' => '1234567890']);
        $this->assertTrue(is_string($response));
    }

    public function testDelete()
    {
        $client = new System();
        $client->setClient($this->guzzle);
        $client->setTokenProvider($this->tokenProvider);

        $response = $client->delete('1234567890');
        $this->assertTrue(is_string($response));

        $response = $client->delete('1234567890', ['deleteGateway' => true]);
        $this->assertTrue(is_string($response));
    }

    public function testDetails()
    {
        $client = new System();
        $client->setClient($this->guzzle);
        $client->setTokenProvider($this->tokenProvider);

        $response = $client->details('1234567890');
        $this->assertTrue(is_string($response));
    }

    public function testGetOptions()
    {
        $client = new System();
        $client->setClient($this->guzzle);
        $client->setTokenProvider($this->tokenProvider);

        $response = $client->getOptions('1234567890');
        $this->assertTrue(is_string($response));
    }
}