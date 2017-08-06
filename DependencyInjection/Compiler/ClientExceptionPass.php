<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ClientExceptionPass
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection\Compiler
 */
class ClientExceptionPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $definition = "m12u.sdk.sierra.iot_m2m.compiler.client_exception_chain";
        if (!$container->hasDefinition($definition)) {
            return;
        }

        $definition = $container->getDefinition($definition);
        $taggedServices = $container->findTaggedServiceIds('m12u.sdk.sierra.iot_m2m.client.exception');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addClientException', array(
                    new Reference($id),
                    $attributes["alias"]
                ));
            }
        }
    }
}