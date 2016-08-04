# Artscore Studio Commerce Bundle

Commerce Bundle is a Symfony 2/3 bundle for create and manage eCommerce features in your Symfony 2/3 application. This package is a part of Artscore Studio Framework.

> IMPORTANT NOTICE: This bundle is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.

## Prerequisites

This version of the bundle requires :
* Symfony >= 2.8 LTS / >= 3+
* [artscorestudio/APYDatagridBundle >= 3.0.0](https://packagist.org/packages/artscorestudio/datagrid-bundle)

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

```yaml
# app/config/config.yml
framework:
    translator: ~
```

For more information about translations, check [Symfony documentation](https://symfony.com/doc/current/book/translation.html).

## Installation

### Step 1 : Download ASFCommerceBundle using composer

Require the bundle with composer :

```bash
$ composer require artscorestudio/commerce-bundle
```

Composer will install the bundle to your project's *vendor/artscorestudio/commerce-bundle* directory. It also install dependencies. 

### Step 2 : Enable the bundle

Enable the bundle in the kernel :

```php
// app/AppKernel.php

public function registerBundles()
{
	$bundles = array(
		// ...
		new ASF\CommerceBundle\ASFCommerceBundle()
		// ...
	);
}
```

### Step 3 : Import ASFCommerceBundle routing files

Now that you have activated and configured the bundle, all that is left to do is import the ASFCommerceBundle routing files.

By importing the routing files you will have ready made pages for things such as cart, Catalog,  homepage, etc.

```yaml
asf_commerce:
    resource: "@ASFCommerceBundle/Resources/config/routing/default.yml"
```

### Step 4 : Configure Entities

You have to set entities managed by the bundle via :

```yaml
asf_commerce:
    cart:
    	entity: Acme\CommerceBundle\Entity\Cart
    catalog: 
    	entity: Acme\CommerceBundle\Entity\Catalog
    discount: 
    	entity: Acme\CommerceBundle\Entity\Discount
    Tax: 
    	entity: Acme\CommerceBundle\Entity\Tax
```

### Next Steps

Now you have completed the basic installation and configuration of the ASFCommerceBundle, you are ready to learn about more advanced features and usages of the bundle.

The following documents are available :
* [Overriding Default ASFCommerceBundle Templates](templates.md)
* [Overriding Default ASFCommerceBundle Controllers](controllers.md)
* [Overriding Default ASFCommerceBundle Forms](forms.md)
* [ASFCommerceBundle Entities](entities.md)
* [Routing Configuration](routing.md)
* [ASFCommerceBundle Configuration Reference](configuration.md)