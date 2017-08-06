<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ProxyPass
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler
 */
class ProxyPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $definition = "m12u.sdk.sierra.iot_m2m.compiler.proxy_chain";
        if (!$container->hasDefinition($definition)) {
            return;
        }

        $definition = $container->getDefinition($definition);
        $taggedServices = $container->findTaggedServiceIds('m12u.sdk.sierra.iot_m2m.proxy');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addProxy', array(
                    new Reference($id),
                    new Reference('m12u.sdk.sierra.iot_m2m.client'),
                    new Reference('m12u.sdk.sierra.iot_m2m.provider.token'),
                    new Reference('m12u.sdk.sierra.iot_m2m.provider_client_exception'),
                    $attributes["alias"]
                ));
            }
        }
    }
}