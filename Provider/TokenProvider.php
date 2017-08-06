<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider;

/**
 * Class TokenProvider
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider
 */
class TokenProvider implements TokenProviderInterface
{
    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $tokenType;

    /**
     * @var string
     */
    protected $refreshToken;

    /**
     * @var string
     */
    protected $expiresAt;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $grantType;

    /**
     * @var string
     */
    protected $uriOauthToken;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * TokenProvider constructor.
     *
     * @param $uriOauthToken
     * @param $clientSecret
     * @param $clientId
     * @param $username
     * @param $password
     * @param string $grantType
     */
    public function __construct($uriOauthToken, $clientSecret, $clientId, $username, $password, $grantType = "password")
    {
        $this->uriOauthToken = $uriOauthToken;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->username = $username;
        $this->password = $password;
        $this->grantType = $grantType;
    }

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return mixed {"access_token":"xx","token_type":"Bearer","refresh_token":"xx","expires_in":86399}
     */
    public function getToken()
    {
        $now = time();
        $token = null;

        if (! $this->hasToken()) {
            $token = $this->getFirstToken();
        } else {
            $token = $this->retrieve();
        }

        if ($this->tokenIsExpire($now, $token->expires_in)) {
            $token = $this->getRefreshToken($token->refresh_token);
        }

        $this->store($token);

        return $token->access_token;
    }

    /**
     * @param \stdClass $token
     */
    public function store($token)
    {
        $this->tokenStorage->store($token);
    }

    /**
     * @return mixed
     */
    public function retrieve()
    {
        return $this->tokenStorage->retrieve();
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        return $this->tokenStorage->hasToken();
    }

    /**
     * @param int $now
     * @param int $expiresIn
     * @return bool
     */
    protected function tokenIsExpire($now, $expiresIn)
    {
        if ($now >= $expiresIn) {
            return false;
        }

        return true;
    }

    /**
     * @param $refreshToken
     * @return \stdClass {"access_token":"xx","token_type":"Bearer","refresh_token":"xx","expires_in":86399}
     */
    protected function getRefreshToken($refreshToken)
    {
        $http_build_query = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        $now = time();
        $token =  $this->getContent($http_build_query);
        $token->expires_in = $now + (int)$token->expires_in;

        return $token;
    }

    /**
     * @return \stdClass {"access_token":"xx","token_type":"Bearer","refresh_token":"xx","expires_in":86399}
     */
    protected function getFirstToken()
    {
        $http_build_query = [
            'grant_type' => 'password',
            'username' => $this->username,
            'password' => $this->password,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        $now = time();
        $token =  $this->getContent($http_build_query);
        $token->expires_in = $now + (int)$token->expires_in;

        return $token;
    }

    /**
     * @throws \RuntimeException if Unabled to retrieve first token with getContent
     * @param array $data
     * @return \stdClass {"access_token":"xx","token_type":"Bearer","refresh_token":"xx","expires_in":86399}
     */
    protected function getContent($data)
    {
        $requestUri = http_build_query($data);
        $tokenUrl = sprintf("%s?%s", $this->uriOauthToken, $requestUri);
        if (! $token = file_get_contents($tokenUrl)) {
            throw new \RuntimeException(
                "Unabled to retrieve first token with getContent");
        }

        return json_decode($token);
    }
}