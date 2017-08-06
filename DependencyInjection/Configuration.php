<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('m12_u_sdk_sierra_iot_m2_m');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $this->addConnectionSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $builder
     */
    private function addConnectionSection(ArrayNodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode('uri_oauth_token')->defaultValue("https://eu.airvantage.net/api/oauth/token")->end()
                ->scalarNode('base_uri')->defaultValue("https://eu.airvantage.net")->end()
                ->scalarNode('username')->cannotBeEmpty()->end()
                ->scalarNode('password')->cannotBeEmpty()->end()
                ->scalarNode('client_id')->cannotBeEmpty()->end()
                ->scalarNode('client_secret')->cannotBeEmpty()->end()
                ->scalarNode('token')->cannotBeEmpty()->end()
                ->arrayNode('authentication')
                    ->children()
                        ->scalarNode('grant_type')->defaultValue("password")->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
