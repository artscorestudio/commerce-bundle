<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CommerceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('asf_commerce');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->booleanNode('enable_catalog_entity')
                    ->defaultFalse()
                ->end()
                ->append($this->addCartParameterNode())
                ->append($this->addCatalogParameterNode())
                ->append($this->addDiscountParameterNode())
                ->append($this->addTaxParameterNode())
            ->end();

        return $treeBuilder;
    }

    /**
     * Add Cart Entity Configuration.
     */
    protected function addCartParameterNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('cart');

        $node
            ->treatTrueLike(array('entity' => null, 'form' => array('type' => "ASF\CommerceBundle\Form\Type\CartType")))
            ->treatFalseLike(array('entity' => null, 'form' => array('type' => "ASF\CommerceBundle\Form\Type\CartType")))
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('entity')
                    ->defaultNull()
                ->end()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')
                            ->defaultValue('ASF\CommerceBundle\Form\Type\CartType')
                        ->end()
                        ->scalarNode('name')
                            ->defaultValue('cart_type')
                        ->end()
                        ->arrayNode('validation_groups')
                            ->prototype('scalar')->end()
                            ->defaultValue(array('Default'))
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }

    /**
     * Add Catalog Entity Configuration.
     */
    protected function addCatalogParameterNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('catalog');

        $node
            ->treatTrueLike(array('entity' => null, 'form' => array('type' => "ASF\CommerceBundle\Form\Type\CatalogType")))
            ->treatFalseLike(array('entity' => null, 'form' => array('type' => "ASF\CommerceBundle\Form\Type\CatalogType")))
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('entity')
                    ->defaultNull()
                ->end()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')
                            ->defaultValue('ASF\CommerceBundle\Form\Type\CatalogType')
                        ->end()
                        ->scalarNode('name')
                            ->defaultValue('catalog_type')
                        ->end()
                        ->arrayNode('validation_groups')
                            ->prototype('scalar')->end()
                            ->defaultValue(array('Default'))
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }

    /**
     * Add Discount Entity Configuration.
     */
    protected function addDiscountParameterNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('discount');

        $node
            ->treatTrueLike(array(
                'entity' => null, 
                'form' => array(
                    'type' => "ASF\CommerceBundle\Form\Type\DiscountType",
                    'name' => "discount_type",
                    'collection' => array(
                        'type' => 'ASF\CommerceBundle\Form\Type\DiscountCollectionType',
                        'name' => 'discount_collection_type'
                    )
                )
            ))
            ->treatFalseLike(array(
                'entity' => null, 
                'form' => array(
                    'type' => "ASF\CommerceBundle\Form\Type\DiscountType",
                    'name' => "discount_type",
                    'collection' => array(
                        'type' => 'ASF\CommerceBundle\Form\Type\DiscountCollectionType',
                        'name' => 'discount_collection_type'
                    )
                )
            ))
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('entity')
                    ->defaultNull()
                ->end()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')
                            ->defaultValue('ASF\CommerceBundle\Form\Type\DiscountType')
                        ->end()
                        ->scalarNode('name')
                            ->defaultValue('discount_type')
                        ->end()
                        ->arrayNode('validation_groups')
                            ->prototype('scalar')->end()
                            ->defaultValue(array('Default'))
                        ->end()
                        ->arrayNode('collection')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('name')
                                    ->defaultValue('discount_collection_type')
                                ->end()
                                ->scalarNode('type')
                                    ->defaultValue('ASF\CommerceBundle\Form\Type\DiscountCollectionType')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }
    
    /**
     * Add Discount Entity Configuration.
     */
    protected function addTaxParameterNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('tax');
    
        $node
            ->treatTrueLike(array(
                'entity' => null, 
                'form' => array(
                    'type' => "ASF\CommerceBundle\Form\Type\TaxType",
                    'name' => "tax_type",
                    'collection' => array(
                        'type' => 'ASF\CommerceBundle\Form\Type\TaxCollectionType',
                        'name' => 'tax_collection_type'
                    )
                )
            ))
            ->treatFalseLike(array(
                'entity' => null, 
                'form' => array(
                    'type' => "ASF\CommerceBundle\Form\Type\TaxType",
                    'name' => "tax_type",
                    'collection' => array(
                        'type' => 'ASF\CommerceBundle\Form\Type\TaxCollectionType',
                        'name' => 'tax_collection_type'
                    )
                )
            ))
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('entity')
                    ->defaultNull()
                ->end()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')
                            ->defaultValue('ASF\CommerceBundle\Form\Type\TaxType')
                        ->end()
                        ->scalarNode('name')
                            ->defaultValue('tax_type')
                        ->end()
                        ->arrayNode('validation_groups')
                            ->prototype('scalar')->end()
                            ->defaultValue(array('Default'))
                        ->end()
                        ->arrayNode('collection')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('name')
                                    ->defaultValue('tax_collection_type')
                                ->end()
                                ->scalarNode('type')
                                    ->defaultValue('ASF\CommerceBundle\Form\Type\TaxCollectionType')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    
        return $node;
    }
}
