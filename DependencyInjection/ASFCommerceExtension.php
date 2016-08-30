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

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ASFCommerceExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services/services.yml');
        
        $this->setCartParameters($container, $loader, $config);
        $this->setCatalogParameters($container, $loader, $config);
        $this->setDiscountParameters($container, $loader, $config);
        $this->setTaxParameters($container, $loader, $config);
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface::prepend()
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        $container->setParameter('asf_commerce.asf_layout_enabled', isset($bundles['ASFLayoutBundle']));
    }
    
    /**
     * Set Cart Entity Parameters in Container.
     * 
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     * @param array            $config
     * 
     * @throws InvalidConfigurationException
     */
    protected function setCartParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['cart']['entity']) {
            throw new InvalidConfigurationException('The asf_commerce.cart.entity parameter must be defined.');
        }

        $container->setParameter('asf_commerce.cart.entity', $config['cart']['entity']);
        $container->setParameter('asf_commerce.cart.form.name', $config['cart']['form']['name']);
        $container->setParameter('asf_commerce.cart.form.type', $config['cart']['form']['type']);
        $loader->load('services/cart.yml');
    }

    /**
     * Set Catalog Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setCatalogParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if ( false === $config['enable_catalog_entity'] ) {
            $container->setParameter('asf_commerce.catalog.entity', $config['catalog']['entity']);
            return;
        }
        
        if (null === $config['catalog']['entity']) {
            throw new InvalidConfigurationException('The asf_commerce.catalog.entity parameter must be defined.');
        }

        $container->setParameter('asf_commerce.catalog.entity', $config['catalog']['entity']);
        $container->setParameter('asf_commerce.catalog.form.name', $config['catalog']['form']['name']);
        $container->setParameter('asf_commerce.catalog.form.type', $config['catalog']['form']['type']);
        $loader->load('services/catalog.yml');
    }

    /**
     * Set Discount Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setDiscountParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['discount']['entity']) {
            throw new InvalidConfigurationException('The asf_commerce.discount.entity parameter must be defined.');
        }

        $container->setParameter('asf_commerce.discount.entity', $config['discount']['entity']);
        $container->setParameter('asf_commerce.discount.form.name', $config['discount']['form']['name']);
        $container->setParameter('asf_commerce.discount.form.type', $config['discount']['form']['type']);
        $container->setParameter('asf_commerce.discount.form.collection.type', $config['discount']['form']['collection']['type']);
        $container->setParameter('asf_commerce.discount.form.collection.name', $config['discount']['form']['collection']['name']);
        $loader->load('services/discount.yml');
    }
    
    /**
     * Set Tax Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setTaxParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['tax']['entity']) {
            throw new InvalidConfigurationException('The asf_commerce.tax.entity parameter must be defined.');
        }
    
        $container->setParameter('asf_commerce.tax.entity', $config['tax']['entity']);
        $container->setParameter('asf_commerce.tax.form.name', $config['tax']['form']['name']);
        $container->setParameter('asf_commerce.tax.form.type', $config['tax']['form']['type']);
        $container->setParameter('asf_commerce.tax.form.collection.type', $config['tax']['form']['collection']['type']);
        $container->setParameter('asf_commerce.tax.form.collection.name', $config['tax']['form']['collection']['name']);
        $loader->load('services/tax.yml');
    }

}
