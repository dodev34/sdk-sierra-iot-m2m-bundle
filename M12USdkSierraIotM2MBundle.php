<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler\ClientExceptionPass;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler\ProxyPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class M12USdkSierraIotM2MBundle
 * @package M12U\Bundle\Sdk\Sierra\IotBundle
 */
class M12USdkSierraIotM2MBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.provider.token_storage.class',
            'M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\CacheStorage'
        );

        $container
            ->register(
                'm12u.sdk.sierra.iot_m2m.provider.token_storage',
                '%m12u.sdk.sierra.iot_m2m.provider.token_storage.class%'
            )
            ->addArgument('%kernel.cache_dir%')
        ;

        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.provider.token.class',
            'M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\TokenProvider');

        $container
            ->register(
                'm12u.sdk.sierra.iot_m2m.provider.token',
                '%m12u.sdk.sierra.iot_m2m.provider.token.class%'
            )
            ->setArguments([
                '%m12u.sdk.sierra.iot_m2m.config.uri_oauth_token%',
                '%m12u.sdk.sierra.iot_m2m.config.client_secret%',
                '%m12u.sdk.sierra.iot_m2m.config.client_id%',
                '%m12u.sdk.sierra.iot_m2m.config.username%',
                '%m12u.sdk.sierra.iot_m2m.config.password%',
                '%m12u.sdk.sierra.iot_m2m.config.grant_type%',
            ])
        ->addMethodCall(
            'setTokenStorage',
            [new Reference('m12u.sdk.sierra.iot_m2m.provider.token_storage')]
        );

        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.provider.proxy.class',
            'M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\ProxyProvider');

        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.provider.client.exception.class',
            'M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\ClientExceptionProvider');

        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.compiler.proxy_chain.class',
            'M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler\ProxyChain');

        $container
            ->register('m12u.sdk.sierra.iot_m2m.compiler.proxy_chain', '%m12u.sdk.sierra.iot_m2m.compiler.proxy_chain.class%');

        $container
            ->register('m12u.sdk.sierra.iot_m2m.provider_proxy', '%m12u.sdk.sierra.iot_m2m.provider.proxy.class%')
            ->addArgument(new Reference('m12u.sdk.sierra.iot_m2m.compiler.proxy_chain'));

        $container
            ->register('m12u.sdk.sierra.iot_m2m.provider_client_exception', '%m12u.sdk.sierra.iot_m2m.provider.client.exception.class%')
            ->addArgument(new Reference('m12u.sdk.sierra.iot_m2m.compiler.client_exception_chain'));

        $container->setParameter(
            'm12u.sdk.sierra.iot_m2m.compiler.client_exception_chain.class',
            'M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler\ClientExceptionChain');
        $container
            ->register('m12u.sdk.sierra.iot_m2m.compiler.client_exception_chain', '%m12u.sdk.sierra.iot_m2m.compiler.client_exception_chain.class%');

        $container->addCompilerPass(new ProxyPass());
        $container->addCompilerPass(new ClientExceptionPass());
    }
}
