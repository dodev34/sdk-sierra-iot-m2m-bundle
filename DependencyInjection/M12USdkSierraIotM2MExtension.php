<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class M12USdkSierraIotM2MExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.config.uri_oauth_token',
            $config['uri_oauth_token']
        );
        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.config.username',
            $config['username']
        );
        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.config.password',
            $config['password']
        );
        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.config.base_uri',
            $config['base_uri']
        );
        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.config.client_id',
            $config['client_id']
        );
        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.config.client_secret',
            $config['client_secret']
        );
        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.config.token',
            $config['token']
        );
        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.config.grant_type',
            $config['authentication']['grant_type']
        );
    }
}
