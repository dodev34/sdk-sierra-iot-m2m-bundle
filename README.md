Documentation
=============

WIP.

How use from scratch

````
// composer.json
{
  "autoload": {
    "psr-4": {
      "M12U\\Bundle\\Sdk\\Sierra\\IotM2MBundle\\": "sdk-sierra-iot-m2m-bundle"
    }
  },

  "require": {
    "php": ">=5.3.0",
    "psr/log": "~1.0",
    "symfony/http-kernel": ">=2.8",
    "symfony/yaml": ">=2.8",
    "symfony/dependency-injection": ">=2.8",
    "guzzlehttp/guzzle": "^6.2",
    "symfony/console": "^3.3",
    "symfony/var-dumper": "^3.3"
  },
  "require-dev": {
    "symfony/framework-bundle": ">=2.8"
  },
  "extra": {
    "branch-alias": {
      "dev-master": "1.0"
    }
  }
}

````

````
# paremeters.yml
parameters:
    m12u.sdk.sierra.iot_m2m.config.uri_oauth_token: "https://eu.airvantage.net/api/oauth/token"
    m12u.sdk.sierra.iot_m2m.config.username: "your_username"
    m12u.sdk.sierra.iot_m2m.config.password: "your_password;"
    m12u.sdk.sierra.iot_m2m.config.base_uri: "https://eu.airvantage.net"
    m12u.sdk.sierra.iot_m2m.config.client_id: "your_client_id"
    m12u.sdk.sierra.iot_m2m.config.client_secret: "yours_client_secret"
    m12u.sdk.sierra.iot_m2m.config.token: "your_token"
    m12u.sdk.sierra.iot_m2m.config.grant_type: "password"
````

````
<?php
require_once __DIR__ . '/vendor/autoload.php';

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\M12USdkSierraIotM2MBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator([
    __DIR__,
    __DIR__.'/sdk-sierra-iot-m2m-bundle/Resources/config'
]));
$loader->load('parameters.yml');
$loader->load('services.yml');

$bundle = new M12USdkSierraIotM2MBundle();
$bundle->build($container);

if (! $container->isCompiled()) {
    $container->compile();
}

$provider = $container->get('m12u.sdk.sierra.iot_m2m.provider_proxy');
$system = $provider->getClient('system');

````
